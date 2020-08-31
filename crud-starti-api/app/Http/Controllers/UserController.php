<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Users;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;


class UserController extends Controller
{
    //
    public function index() {

        return new UserCollection(Users::all());
        // return Users::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'password' => 'required|max:20',
        ]);


            $user = new Users();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->address = $request->address;
            $user->phone = $request->phone;

            $user_password = $user->password;
            $user->password = Hash::make($user_password);

            $found_user = Users::where('email', $user->email)->first();

            if($found_user) {
                $message = 'Já existe um usuário com esse e-mail!';
                return response()->json($message, 400);
            }else {
                $user->save();

                $message = 'Usuário criado com sucesso';
                return response()->json($message, 201);
            }




        // Users::create($request->all());



        // return response()->json($user, 201);
        // return ($user)->response()->setStatusCode(201);
        // $user = Users::create($request->all());


        // return (new UserResource($user))
        //         ->response()
        //         ->setStatusCode(201);
    }

    public function delete($id)
    {
        $user = Users::findOrFail($id);

        if($user) {
            $user->delete();

            $message = 'Usuário deletado com sucesso!';
            return response()->json($message, 200);
        } else {
            $message = 'Usuário não encontrado!';
            return response()->json($message, 404);
        }
    }

    public function update(Request $request, $id) {
        // $request->merge(['correct' => (bool) json_decode($request->get('correct'))]);

        // $request->validate([
        //     'correct' => 'required|boolean'
        // ]);

        $user = Users::findOrFail($id);

        if($user) {
            $user->update($request->all());

            $message = 'Usuário atualizado com sucesso!';
            return response()->json($message, 200);
        } else {

            $message = 'Usuário não encontrado!';
            return response()->json($message, 404);
        }


        // $user->save();

        return new UserResource($user);
    }
}
