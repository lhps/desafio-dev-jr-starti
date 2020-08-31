<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Users;
use Validator;
use Auth;

class SessionController extends Controller
{
    //
     function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email'     =>  'required|email',
            'password'     =>  'required|alphaNum|min:3'
        ]);

        $user_data = array(
            'email'     => $request->get('email'),
            'password'     => $request->get('password'),
        );

        if(Auth::attempt($user_data)) {
            return  response()->setStatusCode(200);
        } else {
            return
                response()
                ->setStatusCode(201);
        }
    }

    function create(Request $request) {
        $user_data = array(
            'email'     => $request->get('email'),
            'password'     => $request->get('password'),
        );


        $user = Users::where('email', $user_data['email'])->first();

        if($user) {
            $user_hashed_password = $user->password;


            if(Hash::check($user_data['password'], $user_hashed_password) == false) {
                $message = 'Verifique as credenciais!';
                return response()->json($message, 404);
            } else {
                return response()->json($user, 200);
            }
        } else {
            $message = 'Verifique as credenciais!';

            return response()->json($message, 404);
        }


    }
}
