<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;
use App\Models\ProjectUser;
use App\Models\TaskUser;

class TaskUserController extends Controller {
    public function assign(Request $request) {
        try {
            ['projectid' => $project_id, 'taskid' => $task_id, 'userid' => $user_id] = $request;

            $projectAssigned = ProjectUser::where([['project_id', '=', $project_id], ['user_id', '=', $user_id]])->first();
            if ($projectAssigned === null) {
                return response()->json(['error' => "The user has not been assigned to this project yet!"]);
            }

            TaskUser::firstOrCreate([
                'task_id' => $task_id,
                'user_id' => $user_id
            ]);

            return response()->json(['success' => "Successfully assigned user to this task!"]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function unassign(Request $request) {
        try {
            ['taskid' => $task_id, 'userid' => $user_id] = $request;
            TaskUser::where([['task_id', '=', $task_id], ['user_id', '=', $user_id]])->delete();
            return response()->json(['success' => "Successfully unassigned user from this task."]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }
}
