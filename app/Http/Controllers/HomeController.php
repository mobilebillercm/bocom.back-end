<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Lubrifiant;
use App\PaymentMethode;
use App\PaymentMthodeType;
use App\PetroleumProduct;
use App\Service;
use App\Station;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $apiController;
    public function __construct()
    {
        $this->middleware('auth');
        $this->apiController = new ApiController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', array('produitpetroliers'=>PetroleumProduct::all(), 'lubrifiants'=>Lubrifiant::all()));
    }

    public function logout(Request $request) {
        Auth::logout();
        Session::flush();
        Cache::flush();
        return redirect('/login');
    }

    public function nouveauProduitPetrolierForm(Request $request){
        return view('products.petroleum.form');
    }

    public function changePasswordForm(Request $request, $userid){
        return view('auth.change-password');
    }

    public function changePassword(Request $request, $userid){

        $validator = Validator::make($request->all(),
            [
                'oldpassword' => 'required|string|min:6',
                'newpassword' => 'required|string|min:6',
                'newpasswordconfirmation' => 'required|string|min:6',

            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $oldpassword = $request->get('oldpassword');
        $newpassword = $request->get('newpassword');
        $newpasswordconfirmation = $request->get('newpasswordconfirmation');

        $users = User::where('userid', '=', $userid)->get();
        if (!(count($users) === 1)){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>"Utilisateur non present dans le system.", 'success'=>0, 'faillure'=>1)));
            //return response(array('success' => 0, 'faillure' => 1, 'raison' => "Utilisateur non present dans le system."), 200);
        }

        $user = $users[0];
        $credentials = ['email'=>$user->email, 'password'=>$oldpassword];
            // attempt to verify the credentials and create a token for the user
            if (! Auth::attempt($credentials)) {
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>array('raison'=>"Echec d'authentification.", 'success'=>0, 'faillure'=>1)));
                //return response(array('success' => 0, 'faillure' => 1, 'raison' => "Echec d'authentification."), 200);
            }


        if (!($newpassword === $newpasswordconfirmation)){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>"Le nouveau mot de passe et sa confirmation sont distincts.", 'success'=>0, 'faillure'=>1)));
            //return response(array('success' => 0, 'faillure' => 1, 'raison' => "Le nouveau mot de passe et sa confirmation sont distincts."), 200);
        }

        $user->password = Hash::make($newpassword);
        $user->save();
        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>"Mot de passe modifie avec succes.", 'success'=>1, 'faillure'=>0)));
        //return response(array('success' => 1, 'faillure' => 0, 'response' => "Mot de passe modifie avec succes.", 'token'=>$token), 200);
    }


    public function nouveauProduitPetrolier(Request $request){

        $validator = Validator::make(
            $request->all(),
            array(
                'name'=>'required|string|max:250',
                'description'=>'required|string',
                'price'=>'required|numeric|min:0',
                'logo'=>'required|file|mimes:jpeg,png,jpg,gif',

            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $name = strtolower($request->get('name'));

        $petroleumProducts = PetroleumProduct::whereRaw('LOWER(`name`) = ?', [$name])->get();
        if (count($petroleumProducts) > 0){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>'Un produit petrolier avec le meme nom existe deja dans le syteme', 'success'=>0, 'faillure'=>1)));
        }

        $logo = $request->file('logo');
        $logo_path = null;
        if (!($logo === null) and $logo->isValid()) {
            $logo_path = Storage::disk('local')->put('petroleum', $logo);
        }




        $petroleumProduct = new PetroleumProduct(Uuid::generate()->string,$request->get('name'),
            $request->get('description'),$request->get('price'), $logo_path);
        $petroleumProduct->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Produit ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));

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


    public function nouveauProduitLubrifiantForm(Request $request){
        return view('products.lubrifiant.form');
    }

    public function nouveauProduitLubrifiant(Request $request){

        $validator = Validator::make(
            $request->all(),
            array(
                'name'=>'required|string|max:250',
                'description'=>'required|string',
                'price'=>'required|numeric|min:0',
                'logo'=>'required|file|mimes:jpeg,png,jpg,gif',

            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $name = strtolower($request->get('name'));

        $lubrifiants = Lubrifiant::whereRaw('LOWER(`name`) = ?', [$name])->get();
        if (count($lubrifiants) > 0){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>'Un produit lubrifiant avec le meme nom existe deja dans le syteme', 'success'=>0, 'faillure'=>1)));
        }

        $logo = $request->file('logo');
        $logo_path = null;
        if (!($logo === null) and $logo->isValid()) {
            $logo_path = Storage::disk('local')->put('lubrifiant', $logo);
        }




        $lubrifiant = new Lubrifiant(Uuid::generate()->string,$request->get('name'),
            $request->get('description'),$request->get('price'), $logo_path);
        $lubrifiant->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Produit Lubrifiant ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));

    }


    public function getLogoProduitLubrifiant(Request $request, $productid){
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


    public function services(Request $request){
        return view('services..services', array('services'=>Service::all()));
    }

    public function nouveauServiceForm(Request $request){
        return view('services.form');
    }


    public function nouveauService(Request $request){

        $validator = Validator::make(
            $request->all(),
            array(
                'name'=>'required|string|max:250',
                'description'=>'required|string',
                'price'=>'required|numeric|min:0',
                'logo'=>'required|file|mimes:jpeg,png,jpg,gif',

            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $name = strtolower($request->get('name'));

        $services = Service::whereRaw('LOWER(`name`) = ?', [$name])->get();
        if (count($services) > 0){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>'Un Service avec le meme nom existe deja dans le syteme', 'success'=>0, 'faillure'=>1)));
        }

        $logo = $request->file('logo');
        $logo_path = null;
        if (!($logo === null) and $logo->isValid()) {
            $logo_path = Storage::disk('local')->put('service', $logo);
        }




        $service = new Service(Uuid::generate()->string,$request->get('name'),
            $request->get('description'),$request->get('price'), $logo_path);
        $service->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Nouveau Service ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));

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

    public function stations(Request $request){
        return view('stations..stations', array('stations'=>Station::all()));
    }

    public function nouvelleStationForm(Request $request){
        return view('stations.form');
    }

    public function nouvelleStation(Request $request){

        $validator = Validator::make(
            $request->all(),
            array(
                'name'=>'required|string|max:250',
                'description'=>'required|string',
                'bp'=>'required|string|max:250',
                'region'=>'required|string|max:250',
                'division'=>'required|string|max:250',
                'subdivision'=>'required|string|max:250',
                'quarter'=>'required|string|max:250',

            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $name = strtolower($request->get('name'));

        $stations = Station::whereRaw('LOWER(`name`) = ?', [$name])->get();
        if (count($stations) > 0){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>'Une Station avec le meme nom existe deja dans le syteme', 'success'=>0, 'faillure'=>1)));
        }


        $station = new Station(Uuid::generate()->string,$request->get('name'), $request->get('description'),
            $request->get('region'), $request->get('division'), $request->get('subdivision'), $request->get('quarter'), $request->get('latitude'),
            $request->get('longitude'),$request->get('bp'), '[]','[]', '[]', '[]', '[]','[]');
        $station->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Nouvelle Station ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));

    }

    public function getStationImage0(Request $request, $stationid){

        $stations = Station::where('stationid', '=', $stationid)->get();

        if (!(count($stations) === 1)){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }

        $images = json_decode($stations[0]->images);
        if (count($images) === 0){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }
        $contents = Storage::disk('local')->get($images[0]);
        return response()->make($contents, 200, array('Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)));

    }

    public function getStationById(Request $request, $stationid){
        $stations = Station::where('stationid', '=', $stationid)->get();

        return view('stations.sheet', array('station'=>$stations[0]));
    }

    public function getStationImage(Request $request, $path, $file){
        $contents = Storage::disk('local')->get($path . '/' . $file);
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));
    }

    public function addImageToStationForm(Request $request, $stationid){
        //return $stationid;
        $stations = Station::where('stationid', '=', $stationid)->get();

        //return json_encode($stations);

        return view('stations.add-image-form', array('station'=>$stations[0]));
    }

    public function addImageToStation(Request $request, $stationid){

        $validator = Validator::make(
            $request->all(),
            array(
                'logo'=>'required|file|mimes:jpeg,png,jpg,gif',
            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $stations = Station::where('stationid', '=', $stationid)->get();


        $logo = $request->file('logo');
        $logo_path = null;
        if (!($logo === null) and $logo->isValid()) {
            $logo_path = Storage::disk('local')->put('station', $logo);
        }


        $station = $stations[0];

        $images = json_decode($station->images);
        array_push($images, $logo_path);
        $station->images = json_encode($images);
        $station->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Image ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));

    }

    public function addContactToStationForm(Request $request, $stationid){
        //return $stationid;
        $stations = Station::where('stationid', '=', $stationid)->get();

        //return json_encode($stations);

        return view('stations.add-contact-form', array('station'=>$stations[0]));
    }


    public function addContactToStation(Request $request, $stationid){

        $validator = Validator::make(
            $request->all(),
            array(
                'tel'=>'required|string|max:250',
                'bp'=>'required|string|max:250',
                'address'=>'required|string|max:250',
                'quarter'=>'required|string|max:250',

            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $stations = Station::where('stationid', '=', $stationid)->get();

        $newcontact = new Contact(json_encode([$request->get('tel')]), $request->get('bp'), $request->get('address'),$request->get('quarter'));


        $station = $stations[0];

        $contacts = json_decode($station->contacts);
        array_push($contacts, $newcontact);
        $station->contacts = json_encode($contacts);
        $station->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Contact ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));

    }


    public function addPetroleumproductToStationForm(Request $request, $stationid){
        //return $stationid;
        $stations = Station::where('stationid', '=', $stationid)->get();
        //
        $stationPPids = json_decode($stations[0]->petroleumproducts);
        $petroleumproducts = [];
        $allpps = PetroleumProduct::all();
        foreach ($allpps as $allpp){
            $found = false;
            foreach ($stationPPids as $pid){
                if ($pid === $allpp->petroleumproductid){
                    $found = true;
                    break;
                }
            }
            if ($found === false){
                array_push($petroleumproducts, $allpp);
            }
        }
        return view('stations.add-petroleumproduct-form', array('station'=>$stations[0], 'petroleumproducts'=>$petroleumproducts));
    }

    public function addPetroleumproductToStation(Request $request, $stationid){

        $validator = Validator::make(
            $request->all(),
            array(
                'petroleumproductid'=>'required|string|max:150',
            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $stations = Station::where('stationid', '=', $stationid)->get();

        $station = $stations[0];

        $ppids = json_decode($station->petroleumproducts);
        array_push($ppids, $request->get('petroleumproductid'));
        $station->petroleumproducts = json_encode($ppids);
        $station->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Produit ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));
    }

    public function addLubrifiantToStationForm(Request $request, $stationid){
        //return $stationid;
        $stations = Station::where('stationid', '=', $stationid)->get();
        //
        $lubrifiantids = json_decode($stations[0]->lubrifiants);
        $lubrifiants = [];
        $alllubrifiants = Lubrifiant::all();
        foreach ($alllubrifiants as $alllubrifiant){
            $found = false;
            foreach ($lubrifiantids as $lubrifiantid){
                if ($lubrifiantid === $alllubrifiant->lubrifiantid){
                    $found = true;
                    break;
                }
            }
            if ($found === false){
                array_push($lubrifiants, $alllubrifiant);
            }
        }
        return view('stations.add-lubrifiant-form', array('station'=>$stations[0], 'lubrifiants'=>$lubrifiants));
    }

    public function addLubrifiantToStation(Request $request, $stationid){

        $validator = Validator::make(
            $request->all(),
            array(
                'lubrifiantid'=>'required|string|max:150',
            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $stations = Station::where('stationid', '=', $stationid)->get();

        $station = $stations[0];

        $lubrifiantids = json_decode($station->lubrifiants);
        array_push($lubrifiantids, $request->get('lubrifiantid'));
        $station->lubrifiants = json_encode($lubrifiantids);
        $station->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Lubrifiant ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));
    }


    public function addServiceToStationForm(Request $request, $stationid){
        //return $stationid;
        $stations = Station::where('stationid', '=', $stationid)->get();
        //
        $serviceids = json_decode($stations[0]->services);
        $services = [];
        $allServices = Service::all();
        foreach ($allServices as $allService){
            $found = false;
            foreach ($serviceids as $serviceid){
                if ($serviceid === $allService->serviceid){
                    $found = true;
                    break;
                }
            }
            if ($found === false){
                array_push($services, $allService);
            }
        }
        return view('stations.add-service-form', array('station'=>$stations[0], 'services'=>$services));
    }

    public function addServiceToStation(Request $request, $stationid){

        $validator = Validator::make(
            $request->all(),
            array(
                'serviceid'=>'required|string|max:150',
            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $stations = Station::where('stationid', '=', $stationid)->get();

        $station = $stations[0];

        $serviceids = json_decode($station->services);
        array_push($serviceids, $request->get('serviceid'));
        $station->services = json_encode($serviceids);
        $station->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Service ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));
    }


    public function addPaymentmethodToStationForm(Request $request, $stationid){
        //return $stationid;
        $stations = Station::where('stationid', '=', $stationid)->get();
        //
        $paymentmethodids = json_decode($stations[0]->paymentmethods);
        $paymentmethods = [];
        $allPaymentmethods = PaymentMethode::all();
        foreach ($allPaymentmethods as $allPaymentmethod){
            $found = false;
            foreach ($paymentmethodids as $paymentmethodid){
                if ($paymentmethodid === $allPaymentmethod->paymentmethodid){
                    $found = true;
                    break;
                }
            }
            if ($found === false){
                array_push($paymentmethods, $allPaymentmethod);
            }
        }
        return view('stations.add-paymentmethod-form', array('station'=>$stations[0], 'paymentmethods'=>$paymentmethods, 'paymentmethodtypes'=>PaymentMthodeType::all()));
    }

    public function createPaymentMethod(Request $request){

        //return $request;

        $validator = Validator::make(
            $request->all(),
            array(
                'name'=>'required|string|max:250',
                'type'=>'required|string|max:150',
                'description'=>'required|string',
                'logo'=>'required|file|mimes:jpeg,png,jpg,gif',
            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $name = strtolower($request->get('name'));

        $paymentMethods = PaymentMethode::whereRaw('LOWER(`name`) = ?', [$name])->get();
        if (count($paymentMethods) > 0){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>'Une Methode de paiement avec le meme nom existe deja dans le syteme', 'success'=>0, 'faillure'=>1)));
        }

        $logo = $request->file('logo');
        $logo_path = null;
        if (!($logo === null) and $logo->isValid()) {
            $logo_path = Storage::disk('local')->put('paymentmethod', $logo);
        }

        $paymentMethodTypes = PaymentMthodeType::where('paymentmethodetypeid', '=', $request->get('type'))->get();
        if (!(count($paymentMethodTypes) === 1)){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>'Type de methode de paiement non existant dans le systeme.', 'success'=>0, 'faillure'=>1)));
        }

        $paymentMethod = new PaymentMethode(Uuid::generate()->string,$request->get('name'),
            $request->get('description'), $request->get('issuer'), $logo_path, $paymentMethodTypes[0]->paymentmethodetypeid, $paymentMethodTypes[0]->name,
            $paymentMethodTypes[0]->description);
        $paymentMethod->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Methode de paiement creee avec succes !!!', 'success'=>1, 'faillure'=>0)));
    }

    public function addPaymentmethodToStation(Request $request, $stationid){

        $validator = Validator::make(
            $request->all(),
            array(
                'paymentmethodid'=>'required|string|max:150',
            )
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$validator->errors()->first(), 'success'=>0, 'faillure'=>1)));
        }

        $stations = Station::where('stationid', '=', $stationid)->get();

        $station = $stations[0];

        $paymentmethods = json_decode($station->paymentmethods);
        array_push($paymentmethods, $request->get('paymentmethodid'));
        $station->paymentmethods = json_encode($paymentmethods);
        $station->save();

        return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Methode de Paiement ajoute avec succes !!!', 'success'=>1, 'faillure'=>0)));
    }



}
