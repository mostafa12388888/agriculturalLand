<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;

class ApiAuthService {


    /**
     * login
     *
     * @param  mixed $email
     * @param  mixed $password
     * @return mixed
     */
    public function login(string $email, string $password): mixed
    {
        $user = User::where('email', $email)->first();
        $response=[];
        $response["user"] = $user;
        if ($response["user"]) {
            $response["user"]= $user;
            if (Hash::check($password, $user->password)) {
                $token = $user->createToken('access_token')->accessToken;
                $response['access_token'] = $token;
                $response["refresh_token"] = '';
                $response["message"] = "success";
                $response['status']=200;
            } else{
                $response["message"] = "Password mismatch";
                $response["refresh_token"] = '';
                $response['access_token'] = '';
                $response['status']=422;
            }
        } else{
            $response["message"] = 'User does not exist';
            $response["refresh_token"] = '';
            $response['access_token'] = '';
            $response['status']=422;
        }
        return (object) $response;
    }
    /**
     * LogOut
     *
     * @return mixed
     */
    public function  LogOut():mixed
    {   $token = auth()->user()->token();
        $token->revoke();
        $response["refresh_token"] = '';
        $response['access_token'] = '';
        $response['status'] = 200;
        $response = ['message' => 'You have been successfully logged out!'];
        return (object) $response;
    }

//     public function login(string $email, string $password): mixed
//     {

//         $oClient = Client::where('password_client', 1)->firstOrFail(); //@TODO: remove this after using it from .env

//         $request = Request::create('oauth/token', 'POST', [
//             'grant_type' => 'password',
//             'client_id' => $oClient->id, //@TODO: use it from env
//             'client_secret' => $oClient->secret, //@TODO: use it from env
//             'username' => $email,
//             'password' => $password,
//             'scope' => '*',
//         ]);
//         $result = app()->handle($request);
// return $result;

//         $tokenData =  json_decode($result->getContent(), true);

//         // if (!isset($tokenData['access_token'])) throw new InvalidLoginCredentialsException();

//         $user = User::where('email' , $email);

//         $data = [];
//         $data['user'] = $user;
//         $data['accessToken'] = $tokenData['access_token'];
//         $data['refreshToken'] = $tokenData['refresh_token'];
//         $data['expiresIn'] = $tokenData['expires_in'];

//         return (object)$data;
//     }
}
