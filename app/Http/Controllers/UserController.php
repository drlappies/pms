<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Throwable;

class UserController extends Controller {
    public function getall() {
        try {
            $user = User::select('id', 'username', 'firstname', 'lastname', 'is_employee', 'is_admin', 'is_project_manager')->get();
            return response()->json(['user' => $user], 200);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function getone(Request $request) {
        try {
            ['id' => $id] = $request;
            [$user] = User::where('id', '=', $id)->select('id', 'username', 'firstname', 'lastname', 'is_employee', 'is_admin', 'is_project_manager')->get();
            $projectsLed = $user->getLeadingProjects()->get();
            $projectsAssignedTo = $user->getAssignedToProjects()->get();

            return response()->json(['user' => $user, 'projects_in_charge' => $projectsLed, 'projects_assigned_to' => $projectsAssignedTo], 200);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function create(Request $request) {
        try {
            ['username' => $username, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname] = $request;

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
                'firstname' => $firstname,
                'lastname' => $lastname,
            ]);

            return response()->json(['success' => "Successfully created user {$user->firstname} {$user->lastname}"], 201);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function update(Request $request, $id) {
        try {
            ['password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'is_admin' => $is_admin, 'is_project_manager' => $is_project_manager] = $request;

            if (empty($password) && empty($email_address) && empty($firstname) && empty($lastname)) {
                return response()->json(['error' => 'Missing required information!'], 400);
            }

            User::where('id', '=', $id)->update([
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'is_admin' => $is_admin,
                'is_project_manager' => $is_project_manager
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
