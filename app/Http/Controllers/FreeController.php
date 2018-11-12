<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSendEmail;
use App\Lubrifiant;
use App\Mail\RegisterMail;
use App\PetroleumProduct;
use App\User;
use App\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class FreeController extends Controller
{
    public function home() {
        if (Auth::check()){
            return view('home', array('produitpetroliers'=>PetroleumProduct::all(), 'lubrifiants'=>Lubrifiant::all()));
        }

        return view('auth.login');

    }

    public function register(Request $request)
    {
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

        $user = User::create(['userid' => Uuid::generate()->string, 'firstname' => $firstname, 'lastname' => $lastname,
            'email' => $email, 'password' => Hash::make($password)]);
        $verification_code = str_random(30); //Generate verification code
        $userverification = UserVerification::create(['userid'=>$user->userid, 'userverificationid'=>Uuid::generate()->string,'url'=>url('user/verify', $verification_code),
            'token'=>$verification_code]);
        //$subject = "Please verify your email address.";
        $registerMailable = new RegisterMail($user, $userverification);
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

        $credentials['is_verified'] = 1;
        if (! $token = Auth::attempt($credentials)) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>'We cant not find an account with this credentials.
             Please make sure you entered the right information and you have verified your email address.',
                    'success'=>0, 'faillure'=>1)));
        }

        return view('home', array('produitpetroliers'=>PetroleumProduct::all(), 'lubrifiants'=>Lubrifiant::all()));
    }
}
