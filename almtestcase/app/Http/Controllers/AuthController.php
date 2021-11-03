<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Manager;
use App\Models\request_for_managers;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $user = new User([
            'nickname' => $request->nickname,
            'password' => $request->password,
            'type' => $request->type
        ]);

        if ($request->type == 0) {
            $client = new Client([
                'nickname' => $request->nickname,
                'password' => $request->password,
                'email' => $request->email,
                'id_user' => $request->user()
            ]);
        } else if ($request->type == 1) {
            $manager = new Manager([
                'nickname' => $request->nickname,
                'password' => $request->password,
                'email' => $request->email,
                'id_user' => $request->user()
            ]);
        }

//        $query =
//            DB::insert(
//                'insert into
//                users (nickname,password,type,created_at,updated_at)
//                values (?,?,?,?,?)',
//                [
//                    $request->nickname,
//                    password_hash($request->password, 1), // можно захешировать чтобы в базу хеш попадал только
//                    $request->type,
//                    date("Y-m-d h:i:s"),
//                    date("Y-m-d h:i:s")
//                ]);

        $query = User::query()
            ->insertGetId([
                'nickname' => $request->nickname,
                'password' => password_hash($request->password, 1),
                'type' => $request->type,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
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

//        return User::query()->select('nickname')->get();
        if (Auth::attempt(['nickname' => $request->nickname, 'password' => $request->password])) {

            $user = $request->user();

            $tokenResult = $user->createToken('Personal Access Token');

//            $query = DB::select(
//                "SELECT * FROM users
//                    where nickname=?
//                 ", [$request->nickname]);

            $query = User::query()
                ->select('*')
                ->where('nickname', '=', $request->nickname)
                ->get();

            if ($query[0]->type == 0) {
//                $client_messages = DB::select(
//                    "SELECT * FROM request_for_managers
//                        WHERE client_name = ?"
//                    , [$request->nickname]
                //);
                $client_messages = request_for_managers::query()
                    ->select('*')
                    ->where('client_name', '=', $request->nickname)
                    ->get();

                return view("components.auth-page-client", ['client_req_info' => $client_messages]);
            } else if ($query[0]->type == 1) {
//                $client_messages = DB::select(
//                    "SELECT * FROM request_for_managers"
//                );
                $client_messages = request_for_managers::query()
                    ->select('*')
                    ->get();
                return view("components.auth-page-manager", ['client_req_info' => $client_messages]);
            }

        } else {
            return response(['message' => 'unauthorized']);
        }
    }

    public static function logout()
    {
        Auth::logout();
    }
}
