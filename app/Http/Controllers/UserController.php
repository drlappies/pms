<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Throwable;

class UserController extends Controller {
    public function index() {
        try {
            return response()->json(User::get(), 200);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function create(Request $request) {
        try {
            ['username' => $username, 'password' => $password, 'email_address' => $email_address, 'firstname' => $firstname, 'lastname' => $lastname] = $request;

            if (empty($username) && empty($password) && empty($email_address) && empty($firstname) && empty($lastname)) {
                return response()->json(['error' => 'Missing required information!'], 400);
            }

            $user = User::where('username', '=', $username)->first();
            if ($user !== null) {
                return response()->json(['error' => 'Username has been taken!'], 400);
            }

            $user = User::firstOrCreate([
                'username' => $username,
                'password' => $password,
                'email_address' => $email_address,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'is_employee' => true
            ]);

            return response()->json(['success' => "Successfully created user {$user->firstname} {$user->lastname}"], 201);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function update(Request $request, $id) {
        try {
            ['password' => $password, 'email_address' => $email_address, 'firstname' => $firstname, 'lastname' => $lastname] = $request;

            if (empty($password) && empty($email_address) && empty($firstname) && empty($lastname)) {
                return response()->json(['error' => 'Missing required information!'], 400);
            }

            User::where('id', '=', $id)->update([
                'password' => $password,
                'email_address' => $email_address,
                'firstname' => $firstname,
                'lastname' => $lastname,
            ]);

            return response()->json(['success' => "Successfully updated user {$id}"]);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }


    public function destroy($id) {
        try {
            User::destroy($id);
            return response()->json(['success' => "Successfuly deleted user {$id}"]);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }
}
