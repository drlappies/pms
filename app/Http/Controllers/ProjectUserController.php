<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectUser;
use Throwable;

class ProjectUserController extends Controller {
    public function assign(Request $request) {
        try {
            ['userid' => $user_id, 'projectid' => $project_id] = $request;

            $assignment = ProjectUser::where([['user_id', '=', $user_id], ['project_id', '=', $project_id]])->first();
            if ($assignment !== null) {
                return response()->json(['error' => 'The employee is already assigned to this project!']);
            }

            ProjectUser::create([
                'user_id' => $user_id,
                'project_id' => $project_id
            ]);

            return response()->json(['success' => "Successfully assigned employee {$user_id} to project {$project_id}"]);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function unassign(Request $request) {
        try {
            ['userid' => $user_id, 'projectid' => $project_id] = $request;

            ProjectUser::where([['user_id', '=', $user_id], ['project_id', '=', $project_id]])->delete();

            return response()->json(['success' => "Successfully unassigned {$user_id} from project {$project_id}"]);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }
}
