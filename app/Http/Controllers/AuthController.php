<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

/**
 * Write static login information to the session.
 * Use for test purposes.
 */
class AuthController extends Controller
{
    public function register_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ab_name' => 'required|max:80|unique:ab_user',
            'ab_mail' => 'required|max:200|unique:ab_user',
            'ab_password' => 'required|max:200',
        ], [
            'ab_name.max' => "Leider ist der Artikelname zu lang.",
            'ab_mail.max' => "Leider ist die Email zu lang.",
            'ab_password.max' => "Leider ist das Passwort zu lang",
            'ab_name.unique' => "Dieser Name wird bereits genutzt.",
            'ab_mail.unique' => "Diese Email wird bereits genutzt.",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $temp = $validator->validated();
            $user = new User([
                'id' => User::max('id') + 1,
                'ab_name' => $temp['ab_name'],
                'ab_password' => $temp['ab_password'],
                'ab_mail' => $temp['ab_mail'],
            ]);
            try {
                $user->save();
            } catch (QueryException $e) {
                return response()->json(
                    [
                        'Fehler mit der Datenbank.',
                        $e,
                    ],
                    500
                );
            }

            return response()->json(
                $user->id,
                200
            );
        }
    }
    public function login_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ab_mail' => 'required|max:200',
            'ab_password' => 'required|max:200',
        ], [
            'ab_mail.max' => "Leider ist die Email zu lang.",
            'ab_password.max' => "Leider ist das Passwort zu lang",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $temp = $validator->validated();
            $id = 0;
            try {
                $id = User::select('id')
                    ->where('ab_mail', $temp['ab_mail'])
                    ->where('ab_password', $temp['ab_password'])
                    ->first();
                if (empty($id)) {
                    return response()->json(
                        ['error' => 'Falsche Eingabedaten.'],
                        400
                    );
                }
            } catch (QueryException $e) {
                return response()->json(
                    ['error' => $e],
                    500
                );
            }
            $request->session()->flush();
            $request->session()->put('user_id', $id->id);
            return response()->json([], 200);
        }
    }

    public function logout_api(Request $request)
    {
        $request->session()->flush();
        //return redirect()->route('login');
    }

    public function loggedIn_api(Request $request)
    {
        if ($request->session()->has("user_id")) {
            return response()->json(
                ['success' => $request->session()->get("user_id")],
                200
            );
        } else {
            return response()->json(
                ['failure' => 'User not logged in'],
                200
            );
        }
    }


    // public function isLoggedIn(Request $request)
    // {
    //     if ($request->session()->has('abalo_user')) {
    //         $r["user"] = $request->session()->get('abalo_user');
    //         $r["time"] = $request->session()->get('abalo_time');
    //         $r["mail"] = $request->session()->get('abalo_mail');
    //         $r["auth"] = true;
    //     } else if ($request->session()->has('user_id')) {
    //         $r["auth"] = true;
    //         $r["id"] = $request->session()->get('user_id');
    //     } else $r["auth"] = false;

    //     return response()->json($r);
    // }

    // public function getId(Request $request)
    // {
    //     if ($request->session()->has('user_id')) {

    //         $id = $request->session()->get('user_id');
    //         return response()->json($id);
    //     } else {
    //         return response()->json("Keine Benutzer angemeldet", 404);
    //     }
    // }
}
