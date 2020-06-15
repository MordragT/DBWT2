<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Write static login information to the session.
 * Use for test purposes.
 */
class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->session()->flush();

        if ($request->has("id")) {
            $id = $request->get("id");
            $request->session()->put('user_id', $id);
        } else {
            $request->session()->put('abalo_user', 'visitor');
            $request->session()->put('abalo_mail', 'visitor@abalo.example.com');
            $request->session()->put('abalo_time', time());
        }

        return redirect()->route('haslogin');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('haslogin');
    }


    public function isLoggedIn(Request $request)
    {
        if ($request->session()->has('abalo_user')) {
            $r["user"] = $request->session()->get('abalo_user');
            $r["time"] = $request->session()->get('abalo_time');
            $r["mail"] = $request->session()->get('abalo_mail');
            $r["auth"] = true;
        } else if ($request->session()->has('user_id')) {
            $r["auth"] = true;
            $r["id"] = $request->session()->get('user_id');
        } else $r["auth"] = false;

        return response()->json($r);
    }

    public function getId(Request $request)
    {
        if ($request->session()->has('user_id')) {

            $id = $request->session()->get('user_id');
            return response()->json($id);
        }
        else {
            return response()->json("Keine Benutzer angemeldet", 404);
        }
    }
}
