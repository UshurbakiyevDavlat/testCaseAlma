<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            'nickname' => 'required',
            'password' => 'required',
            'type' => 'required'
        ]);
        $query =
            DB::insert(
                'insert into
                users (nickname,password,type,created_at,updated_at)
                values (?,?,?,?,?)',
                [
                    $request->nickname,
                    $request->password, // можно захешировать чтобы в базу хеш попадал только
                    $request->type,
                    date("Y-m-d h:i:s"),
                    date("Y-m-d h:i:s")
                ]);

        if ($query) {
            return view("components.reg-success");
        } else {
            return response(['message' => 'error'], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'nickname' => 'required',
            'password' => 'required',
        ]);
        $query = DB::select(
            "SELECT * FROM users
                    where nickname=?
                      AND password = ?
                 ", [$request->nickname, $request->password]);

        if ($query[0]->nickname) {

            if ($query[0]->type == 0) {
                $client_messages = DB::select(
                    "SELECT * FROM request_for_managers
                        WHERE client_name = ?"
                    , [$request->nickname]
                );
                return view("components.auth-page-client",['client_req_info'=>$client_messages]);
            } else if ($query[0]->type == 1) {
                $client_messages = DB::select(
                    "SELECT * FROM request_for_managers"
                );
                return view("components.auth-page-manager",['client_req_info'=>$client_messages]);
            }
        } else {
            return response(['message' => 'Нет такого пользователя'], 400);
        }
    }


}
