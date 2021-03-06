<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\request_for_managers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class InfoController extends Controller
{
    public function makeReq(Request $request)
    {
        $request->validate([
            'theme' => 'required',
            'message' => 'required',
            'client_name' => 'required',
            'email_client' => 'required'
        ]);
//        $timeConst = DB::select
//        ('select testcase.request_for_managers.created_at
//                from testcase.request_for_managers
//                inner join testcase.clients on testcase.clients.id_user = testcase.request_for_managers.id_user
//                where testcase.request_for_managers.email_client = ?',
//            [$request->email_client]);
        $timeConst = request_for_managers::query()
            ->select('request_for_managers.created_at')
            //->join('clients as c', 'c.id_user', '=', 'request_for_managers.id_user')
            ->where('email_client', '=', $request->email_client)
            ->get();


        $folder_name = "client_files";
        $file_name = \Illuminate\Support\Str::random(20);
        if ($request->file("file_client")) {
            Storage::disk('public')->put($folder_name,$request->file(),$file_name);
        }

        if (isset($timeConst[0]->created_at)) {
            $datetime1 = date_create($timeConst[0]->created_at);
            $datetime2 = date_create(date("Y-m-d h:i:s"));
            $interval = date_diff($datetime1, $datetime2);
            if ($interval->days >= 1 || $interval->days == []) {

//                $query = DB::insert("insert into
//                testcase.request_for_managers(theme,id_user, message, client_name, email_client, created_at)
//                values (?,?,?,?,?,?)", [$request->theme,Auth::id(),$request->message, $request->client_name, $request->email_client, date("Y-m-d h:i:s")]);
//
                $query = request_for_managers::query()
                    ->insertGetId([
                        'theme' => $request->theme,
                        'id_user' => Auth::id(),
                        'message' => $request->message,
                        'client_name' => $request->client_name,
                        'respo'=>'nothing',
                        'file_client'=>Storage::url($folder_name.DIRECTORY_SEPARATOR.$file_name),
                        'email_client' => $request->email,
                        'created_at'=>date('Y-m-d h:i:s')
                    ]);

                if ($query) {
                    return view('components.success-req');
                } else {
                    return response(['message' => "errorSQL"], 500);
                }
            } else {
                print("?????????????????????? ?????? ???????????????? ???????????????? ??????????????????!\n");
                echo "<br/>";
                print("?????????? ???????????????????? ???????? 1 ?????? ?? ??????????!");
            }
        } else {
//            $query = DB::insert("insert into
//            testcase.request_for_managers(theme,id_user,message, client_name, email_client, created_at,respo)
//            values (?,?,?,?,?,?,?)", [$request->theme, Auth::id(), $request->message, $request->client_name, $request->email_client, date("Y-m-d h:i:s"), "nothing"]);
            $query = request_for_managers::query()
                ->insertGetId([
                    'theme' => $request->theme,
                    'id_user' => Auth::id(),
                    'message' => $request->message,
                    'client_name' => $request->client_name,
                    'email_client' => $request->email_client,
                    'respo'=>'nothing',
                    'file_client'=>Storage::url($folder_name.DIRECTORY_SEPARATOR.$file_name),
                    'created_at'=>date('Y-m-d h:i:s')
                ]);

            if ($query) {
                return view('components.success-req');
            } else {
                return response(['message' => "errorSQL"], 500);
            }
        }
        $listManagerEmails = Manager::query()
            ->select('email','nickname')
            ->get();
//        foreach ($listManagerEmails as $key => $value) {
//            Mail::send('components.email-notice', array($key=>$value), function($message) use ($key,$value)
//            {
////                print_r($value->email);
//                $message->to($value->email,$value->nickname)->subject('????????!');
//            });
//        }
    }

    public function updateReq(Request $request)
    {
        $request->validate([
            'respo' => 'required',
            'id' => 'required'
        ]);

//        $query = DB::update(
//            "update testcase.request_for_managers set respo = ?,updated_at = ? WHERE id = ?
//", [$request->respo, date('Y-m-d h:i:s'), $request->id]);

        $query = request_for_managers::query()
            ->where('id','=',$request->id)
            ->update([
               'respo'=>$request->respo,
                'updated_at'=>date('Y-m-d h:i:s'),
            ]);
        if ($query) {
            return view('components.success-req');
        } else {
            return response(['message' => "errorSQL"], 500);
        }

    }
}
