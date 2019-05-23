<?php
namespace App\Http\Controllers;
use App\Jobs\ProcessSendEmail;
use App\Mail\RegisterMail;
use App\Mail\ResetPasswordMail;
use App\ResetPassword;
use App\UserVerification;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Webpatser\Uuid\Uuid;

class AuthController extends Controller
{
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }

        if (!($request->get('password') === $request->get('password_confirmation'))){
            return response()->json(['success'=> false, 'error'=> "Passwords not match"]);
        }
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::create(['userid' => Uuid::generate()->string, 'firstname' => $firstname, 'lastname' => $lastname,
            'email' => $email, 'password' => Hash::make($password)]);
        $verification_code = str_random(30); //Generate verification code
        $userverification = UserVerification::create(['userid'=>$user->userid, 'userverificationid'=>Uuid::generate()->string,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        Mail::to($email)->send(new RegisterMail($user, $userverification));
        /*Mail::send('email.verify', ['name' => $firstname . ' ' . $lastname, 'verification_code' => $verification_code],
            function($mail) use ($email, $firstname, $lastname, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), "De Bocom/ BOCOMPetroleum sa");
                $mail->to($email, $firstname . ' ' . $lastname);
                $mail->subject($subject);
            });*/
        return response()->json(['success'=> true, 'message'=> 'Merci de vous Enregistrer! Veuillez verifier votre boite e-mail pour completer votre enregistrement.']);
    }

    /**
     * API Verify User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUser($verification_code)
    {
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();
        if(!is_null($check)){
            $users = User::where('userid', '=', $check->userid)->get();
            if(!(count($users) === 1) or $users[0]->is_verified == 1){
                /*return response()->json([
                    'success'=> false,
                    'message'=> 'Account already verified..'
                ]);*/
                return view('auth.passwords.error', array('message'=>'Account already verified..'));
            }
            $user = $users[0];
            $user->update(['is_verified' => 1]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();
            /*return response()->json([
                'success'=> true,
                'message'=> 'You have successfully verified your email address.'
            ]);*/
            return view('auth.login', array('message'=>'You have successfully verified your email address.'));
        }
        //return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
        return view('auth.passwords.error', array('message'=>"Verification code is invalid."));
    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }

	$user = User::where('email', $request->email)->where('is_verified', '=', 1)->first();
        if (!$user) {
            $error_message = "Your email address was not found or was not verified.";
            return response()->json(['success' => false, 'error' => ['message'=> $error_message]], 200);
            /*return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$error_message, 'success'=>0, 'faillure'=>1)));*/
        }
        //$credentials['is_verified'] = 1;

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'We cant not find an account with this credentials.
                 Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }
        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token, 'user'=>Auth::user()]], 200);
    }
    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        //return $request->get('token');
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }


    /**
     * API Recover Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recover(Request $request)
    {

        $credentials = $request->only('email');

        $rules = [
            'email' => 'required|email|max:255',
        ];

        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()){
            return response()->json(['success' => false, 'error' => ['message'=> $validator->errors()->first()]], 200);
        }


        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['message'=> $error_message]], 200);
            /*return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>$error_message, 'success'=>0, 'faillure'=>1)));*/
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
            return response()->json(['success' => false, 'error' => ['message'=> "Something went wrong"]], 200);
            /*return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>"Something went wrong", 'success'=>0, 'faillure'=>1)));*/
        }


        $registerMailable = new ResetPasswordMail($from, $template, $user, $url);
        ProcessSendEmail::dispatch($user->email, $registerMailable);
        return response()->json([
            'success' => true, 'data'=> ['message'=> 'Veuillez verifier votre boite e-mail pour completer le processus.']
        ]);

        /*return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
            'result'=>array('response'=>'Veuillez verifier votre boite e-mail pour completer le processus.', 'success'=>1, 'faillure'=>0)));*/

        /*$user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }
        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your Password Reset Link');
            });
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
        return response()->json([
            'success' => true, 'data'=> ['message'=> 'A reset email has been sent! Please check your email.']
        ]);*/
    }


}
