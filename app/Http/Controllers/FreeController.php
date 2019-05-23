<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSendEmail;
use App\Lubrifiant;
use App\Mail\RegisterMail;
use App\Mail\ResetPasswordMail;
use App\PaymentMethode;
use App\PaymentMthodeType;
use App\PetroleumProduct;
use App\ResetPassword;
use App\Service;
use App\Station;
use App\User;
use App\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class FreeController extends Controller
{
    public function getAllStation(Request $request){
        return response(array('success'=>1, 'faillure'=>0, 'response'=>Station::all()), 200);
    }

    public function getImage0(Request $request, $stationid){
        $stations = Station::where('stationid', '=', $stationid)->get();

        if (!(count($stations) === 1)){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }



        $images = json_decode($stations[0]->images);
        //return count($images);
        if ((count($images) === 0)){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }
        $contents = Storage::disk('local')->get($images[0]);
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));
    }
    public function home() {
        if (Auth::check()){
            return view('home', array('produitpetroliers'=>PetroleumProduct::all(), 'lubrifiants'=>Lubrifiant::all()));
        }

        return view('auth.login');

    }

    public function register(Request $request){

        $credentials = $request->only('firstname', 'lastname', 'email', 'password', 'password_confirmation');

        $rules = [
            'firstname' => 'required|max:250',
            'lastname' => 'required|max:250',
            'email' => 'required|email|max:255|unique:users',
            'password'=>'required|string|min:6|max:50',
            'password_confirmation'=>'required|string|min:6|max:50'
        ];

        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        if (!($request->get('password') === $request->get('password_confirmation'))){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>"Le mot de passe et sa confirmation sont distincts", 'success'=>0, 'faillure'=>1)));
        }

        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::create(['userid' => Uuid::generate()->string, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'password' => Hash::make($password)]);
        $verification_code = str_random(30); //Generate verification code
        $userverification = UserVerification::create(['userid'=>$user->userid, 'userverificationid'=>Uuid::generate()->string,'url'=>url('user/verify', $verification_code), 'token'=>$verification_code]);

        $template = 'email.verify';
        $from = env('MAIL_USERNAME');

        $registerMailable = new RegisterMail($from, $template, $user, $userverification);
        ProcessSendEmail::dispatch($email, $registerMailable);

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Merci de vous Enregistrer! Veuillez verifier votre boite e-mail pour completer votre enregistrement.', 'success'=>1, 'faillure'=>0)));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }


	$user = User::where('email', $request->email)->where('is_verified', '=', 1)->first();
        if (!$user) {
            $error_message = "Your email address was not found or was not verified.";
            //return response()->json(['success' => false, 'error' => ['message'=> $error_message]], 200);
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$error_message, 'success'=>0, 'faillure'=>1)));
        }

        if (! $token = Auth::attempt($credentials)) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>'We cant not find an account with this credentials.
             Please make sure you entered the right information and you have verified your email address.',
                    'success'=>0, 'faillure'=>1)));
        }

        return view('home', array('produitpetroliers'=>PetroleumProduct::all(), 'lubrifiants'=>Lubrifiant::all()));
    }

    public function getStationById(Request $request, $stationid){
        $stations = Station::where('stationid', '=', $stationid)->get();

        if (!(count($stations) === 1)){
            return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong"), 200);
        }

        return response(array('success'=>1, 'faillure'=>0, 'response'=>$stations[0]), 200);

    }


    public function getDetailsOfStation(Request $request, $stationid){
        $stations = Station::where('stationid', '=', $stationid)->get();

        if (!(count($stations) === 1)){
            return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong 0 " . $stationid), 200);
        }

        $PetroleumProducts = [];
        $station = $stations[0];
        $petroleumproductids = json_decode($station->petroleumproducts);
        foreach ($petroleumproductids as $petroleumproductid) {
            $petroleumproducts = PetroleumProduct::where('petroleumproductid', '=', $petroleumproductid)->get();
            if (!(count($petroleumproducts) === 1)){
                return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong " . $petroleumproductid), 200);
            }
            array_push($PetroleumProducts, $petroleumproducts[0]);
        }


        $services = [];
        $serviceids = json_decode($station->services);
        foreach ($serviceids as $serviceid) {
            $servicess = Service::where('serviceid', '=', $serviceid)->get();
            if (!(count($servicess) === 1)){
                return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong " . $petroleumproductid), 200);
            }
            array_push($services, $servicess[0]);
        }


        $lubrifiants = [];
        $lubrifiantids = json_decode($station->lubrifiants);
        foreach ($lubrifiantids as $lubrifiantid) {
            $lubrifiantss = Lubrifiant::where('lubrifiantid', '=', $lubrifiantid)->get();
            if (!(count($lubrifiantss) === 1)){
                return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong " . $lubrifiantid), 200);
            }
            array_push($lubrifiants, $lubrifiantss[0]);
        }


        $paymentmethods = [];
        $paymentmethodids = json_decode($station->paymentmethods);
        foreach ($paymentmethodids as $paymentmethodid) {
            $paymentmethodidss = PaymentMethode::where('paymentmethodid', '=', $paymentmethodid)->get();
            if (!(count($paymentmethodidss) === 1)){
                return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong " . $paymentmethodid), 200);
            }
            array_push($paymentmethods, $paymentmethodidss[0]);
        }

        $images  = json_decode($station->images);


        $contacts  = json_decode($station->contacts);
        return response(array('success'=>1, 'faillure'=>0, 'response'=>array('petroleumproducts'=>$PetroleumProducts,
            'services'=>$services, 'lubrifiants'=>$lubrifiants, 'paymentmethods'=>$paymentmethods, 'images'=>$images,'contacts'=>$contacts)), 200);

    }

    public function getLogoProduitPetrolier(Request $request, $productid){
        $productPetroleums = PetroleumProduct::where('petroleumproductid', '=', $productid)->get();

        if (!(count($productPetroleums) === 1)){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }

        $contents = Storage::disk('local')->get($productPetroleums[0]->logo);
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));

    }


    public function getLogoService(Request $request, $serviceid){
        $services = Service::where('serviceid', '=', $serviceid)->get();

        if (!(count($services) === 1)){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }

        $contents = Storage::disk('local')->get($services[0]->logo);
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));

    }

    public function getLogoLubrifiant(Request $request, $lubrifiantid){
        $lubrifiants = Lubrifiant::where('lubrifiantid', '=', $lubrifiantid)->get();

        if (!(count($lubrifiants) === 1)){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }

        $contents = Storage::disk('local')->get($lubrifiants[0]->logo);
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));

    }

    public function getLogoProduct(Request $request, $productid){

        $productPetroleums = PetroleumProduct::where('petroleumproductid', '=', $productid)->get();

        if (!(count($productPetroleums) === 1)){

            $lubrifiants = Lubrifiant::where('lubrifiantid', '=', $productid)->get();

            if (!(count($lubrifiants) === 1)){
                return response()->make(null, 200, array(
                    'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
                ));
            }

            $contents = Storage::disk('local')->get($lubrifiants[0]->logo);
            return response()->make($contents, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
            ));
        }

        $contents = Storage::disk('local')->get($productPetroleums[0]->logo);
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));
    }

    public function getLogoPaymentmethods(Request $request, $paymentmethodid){
        $paymentmethods = PaymentMethode::where('paymentmethodid', '=', $paymentmethodid)->get();

        if (!(count($paymentmethods) === 1)){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }

        $contents = Storage::disk('local')->get($paymentmethods[0]->logo);
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));

    }

    public function getStationImage(Request $request, $p, $f){
        $contents = Storage::disk('local')->get($p.'/'.$f);
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));
    }


    public function getAllProducts(Request $request){
        $products = [];

        $petroleumProducts = PetroleumProduct::all();
        foreach ($petroleumProducts as $petroleumProduct){
            $petroleumProduct->productid = $petroleumProduct->petroleumproductid;
            $petroleumProduct->type = "petroleum";
            array_push($products, $petroleumProduct);
        }
        $lubrifiants = Lubrifiant::all();

        foreach ($lubrifiants as $lubrifiant){
            $lubrifiant->productid = $lubrifiant->lubrifiantid;
            $lubrifiant->type = "lubrifiant";
           array_push($products, $lubrifiant);
        }

        return response(array('success'=>1, 'faillure'=>0, 'response'=>$products), 200);
    }

    public function getAllServices(Request $request){
        return response(array('success'=>1, 'faillure'=>0, 'response'=>Service::all()), 200);
    }

    public function getAllPaymentmethods(Request $request){
        return response(array('success'=>1, 'faillure'=>0, 'response'=>PaymentMethode::all()), 200);
    }





    public function getStationsByProduct(Request $request, $productid){
        $stations = [];
        $allstations = Station::all();
        foreach ($allstations as $allstation){

            $found = false;
            $petroleumProductsids = json_decode($allstation->petroleumproducts);
            foreach ($petroleumProductsids as $petroleumProductsid){
                if ($petroleumProductsid === $productid){
                    array_push($stations, $allstation);
                    $found = true;
                    break;
                }
            }
            if (!$found){
                $lubrifiantsids = json_decode($allstation->lubrifiants);
                foreach ($lubrifiantsids as $lubrifiantsid){
                    if ($lubrifiantsid === $productid){
                        array_push($stations, $allstation);
                        break;
                    }
                }
            }

        }

        return response(array('success'=>1, 'faillure'=>0, 'response'=>$stations), 200);
    }


    public function getStationsByService(Request $request, $serviceid){
        $stations = [];
        $allstations = Station::all();
        foreach ($allstations as $allstation){
            $servicesids = json_decode($allstation->services);
            foreach ($servicesids as $servicesid){
                if ($servicesid === $serviceid){
                    array_push($stations, $allstation);
                    break;
                }
            }
        }

        return response(array('success'=>1, 'faillure'=>0, 'response'=>$stations), 200);
    }

    public function getStationsByPaymentMethod(Request $request, $pmId){
        $stations = [];
        $allstations = Station::all();
        foreach ($allstations as $allstation){
            $paymentmethodids = json_decode($allstation->paymentmethods);
            foreach ($paymentmethodids as $paymentmethodid){
                if ($paymentmethodid === $pmId){
                    array_push($stations, $allstation);
                    break;
                }
            }
        }

        return response(array('success'=>1, 'faillure'=>0, 'response'=>$stations), 200);
    }




    public function regle_utilisation_bocom_mobile(Request $request){
        //regles-pridesoft-mobile
        return view('regles-pridesoft-mobile');
    }

    public function recover(Request $request){


        $credentials = $request->only('email');

        $rules = [
            'email' => 'required|email|max:255',
        ];

        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }


        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            //return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$error_message, 'success'=>0, 'faillure'=>1)));
        }

        $restpwds = ResetPassword::where('userid', '=', $user->userid)->get();


        $template = 'email.reset-password';
        $from = env('MAIL_USERNAME');
        $uuid = null;
        $url = null;
        if (count($restpwds) === 1){
            //$uuid = $restpwds[0]->resetpasswordid;
            $url  = $restpwds[0]->url;
        }elseif(count($restpwds) === 0){
            $uuid = Uuid::generate()->string;
            $url  = url('reset-password/'.$uuid);
            $resetPassword = new ResetPassword($uuid, $user->userid, $url);
            $resetPassword->save();
        }else{
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>"Something went wrong", 'success'=>0, 'faillure'=>1)));
        }


        $registerMailable = new ResetPasswordMail($from, $template, $user, $url);
        ProcessSendEmail::dispatch($user->email, $registerMailable);

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Veuillez verifier votre boite e-mail pour completer le processus.', 'success'=>1, 'faillure'=>0)));

    }

    public function resetForm(Request $request, $resetid){
        $resetPwds = ResetPassword::where('resetpasswordid', '=', $resetid)->get();
        if(count($resetPwds) === 0){
            return view('auth.passwords.error');
        }

        $user =         $user = User::where('userid', $resetPwds[0]->userid)->first();
        if (!$user) {
            return view('auth.passwords.error');
        }

        return view('auth.passwords.resetpassword', array('user'=>$user));

    }

    public function reset(Request $request, $userid){
        $user =         $user = User::where('userid', $userid)->first();
        if (!$user) {
            return view('auth.passwords.error');
        }

        $credentials = $request->only('password', 'password_confirmation');

        $rules = [
            'password'=>'required|string|min:6|max:50',
            'password_confirmation'=>'required|string|min:6|max:50'
        ];

        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        if (!($request->get('password') === $request->get('password_confirmation'))){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>"Le mot de passe et sa confirmation sont distincts", 'success'=>0, 'faillure'=>1)));
        }

        $user->password = Hash::make($request->get('password'));
        $user->save();

        $resetPwds = ResetPassword::where('userid', '=', $userid)->get();
        foreach ($resetPwds as $resetPwd){
            $resetPwd->delete();
        }

        return view('auth.login',array('reconfigurepwdmessage' => 'Votre Mot de Passe a ete reconfigure avec succes.'));
    }

    public function recoverForm(Request $request){
        return view('auth.recover');
    }

}
