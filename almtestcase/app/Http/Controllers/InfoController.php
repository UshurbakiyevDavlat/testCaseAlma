<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $query = DB::insert(
            "insert into
testcase.request_for_managers(theme, message, client_name, email_client, created_at)
values (?,?,?,?,?)", [$request->theme, $request->message, $request->client_name, $request->email_client, date("Y-m-d h:i:s")]);
        if ($query) {
            return view('components.success-req');
        } else {
            return response(['message' => "errorSQL"], 500);
        }
    }
}
