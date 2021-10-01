<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;
use App\Models\SubtaskUser;
use App\Models\Task;

class SubtaskUserController extends Controller {
    public function assign(Request $request) {
        try {
            ['taskid' => $task_id, 'subtaskid' => $subtask_id, 'userid' => $user_id] = $request;

            $task = Task::where('id', '=', $task_id);
            if ($task === null) {
                return response()->json(['error' => "The user has not been assigned to this task yet!"]);
            }

            SubtaskUser::firstOrCreate([
                'subtask_id' => $subtask_id,
                'user_id' => $user_id
            ]);

            return response()->json(['success' => "Successfully assigned the user to this task."]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function unassign(Request $request) {
        try {
            ['taskid' => $task_id, 'subtaskid' => $subtask_id, 'userid' => $user_id] = $request;
            SubtaskUser::where([['subtask_id', '=', $subtask_id], ['user_id', '=', $user_id]]);

            return response()->json(['success' => "Successfully unassigned the user from this task."]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }
}
