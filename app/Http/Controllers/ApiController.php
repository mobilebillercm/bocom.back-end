<?php

namespace App\Http\Controllers;

use App\Station;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function updateStation(Request $request, $stationid){
        $dataString = file_get_contents('php://input');
        $data =  json_decode($dataString, true);

        if ($request->get('action') == 'geolocate'){
            $validator = Validator::make($data,
                [
                    'latitude' => 'required|numeric',
                    'longitude' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {
                return response(array('success' => 0, 'faillure' => 1, 'raison' => $validator->errors()->first()), 200);
            }
            $latitude = $data['latitude'];
            $longitude = $data['longitude'];

            $stations = Station::where('stationid', '=', $stationid)->get();
            if (!(count($stations) === 1)){
                return response(array('success' => 0, 'faillure' => 1, 'raison' => "No Station found"), 200);
            }

            $station = $stations[0];
            $station->latitude = $latitude;
            $station->longitude = $longitude;
            $station->save();
            return response(array('success' => 1, 'faillure' => 0, 'response' => "Station Geolocate successfully."), 200);
        }


    }

    public function updateUser(Request $request, $userid){
        $dataString = file_get_contents('php://input');
        $data =  json_decode($dataString, true);

        if ($request->get('action') == 'changepassword'){
            $validator = Validator::make($data,
                [
                    'oldpassword' => 'required|string|min:6',
                    'newpassword' => 'required|string|min:6',
                    'newpasswordconfirmation' => 'required|string|min:6',

                ]
            );

            if ($validator->fails()) {
                return response(array('success' => 0, 'faillure' => 1, 'raison' => $validator->errors()->first()), 200);
            }

            $oldpassword = $data['oldpassword'];
            $newpassword = $data['newpassword'];
            $newpasswordconfirmation = $data['newpasswordconfirmation'];

            $users = User::where('userid', '=', $userid)->get();
            if (!(count($users) === 1)){
                return response(array('success' => 0, 'faillure' => 1, 'raison' => "Utilisateur non present dans le system."), 200);
            }

            $user = $users[0];
            $credentials = ['email'=>$user->email, 'password'=>$oldpassword];
            try {
                // attempt to verify the credentials and create a token for the user
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response(array('success' => 0, 'faillure' => 1, 'raison' => "Echec d'authentification."), 200);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return response(array('success' => 0, 'faillure' => 1, 'raison' => "Echec d'authentification. 1"), 200);            }

            if (!($newpassword === $newpasswordconfirmation)){
                return response(array('success' => 0, 'faillure' => 1, 'raison' => "Le nouveau mot de passe et sa confirmation sont distincts."), 200);
            }

            $user->password = Hash::make($newpassword);
            $user->save();
            return response(array('success' => 1, 'faillure' => 0, 'response' => "Mot de passe modifie avec succes.", 'token'=>$token), 200);
        }
    }

}
