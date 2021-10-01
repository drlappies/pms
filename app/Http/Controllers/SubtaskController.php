<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;
use App\Models\Subtask;
use DateTime;

class SubtaskController extends Controller {
    public function getall(Request $request) {
        try {
            ["taskid" => $task_id] = $request;
            $subtasks = Subtask::with('task')->where('task_id', '=', $task_id)->get();
            return response()->json(['subtasks' => $subtasks]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function getone(Request $request) {
        try {
            ["taskid" => $task_id, "subtaskid" => $subtask_id] = $request;

            [$subtask] = Subtask::where([['task_id', '=', $task_id], ['id', '=', $subtask_id]])->get();
            [$parentTask] = $subtask->task()->get();
            return response()->json(['subtask' => $subtask, 'parent_task' => $parentTask]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function create(Request $request) {
        try {
            ["taskid" => $task_id, "title" => $title, "desc" => $desc, "start_datetime" => $start_datetime, "due_datetime" => $due_datetime, "priority" => $priority, "status" => $status] = $request;

            if (empty($title) && empty($priority) && empty($status)) {
                return response()->json(['error' => "Missing required information!"]);
            }

            if (new DateTime($start_datetime) >= new DateTime($due_datetime)) {
                return response()->json(['error' => 'Subtask starting date cannot be later than its due date!']);
            }

            $subtask = Subtask::create([
                'task_id' => $task_id,
                'title' => $title,
                'desc' => $desc,
                'start_datetime' => $start_datetime,
                'due_datetime' => $due_datetime,
                'priority' => $priority,
                'status' => $status,
            ]);

            return response()->json(['succses' => "Successfully created subtask {$subtask->title}"]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function update(Request $request) {
        try {
            ["subtaskid" => $subtask_id, "taskid" => $task_id, "title" => $title, "desc" => $desc, "start_datetime" => $start_datetime, "due_datetime" => $due_datetime, "priority" => $priority, "status" => $status] = $request;

            if (empty($title) && empty($priority) && empty($status)) {
                return response()->json(['error' => "Missing required information!"]);
            }

            if (new DateTime($start_datetime) >= new DateTime($due_datetime)) {
                return response()->json(['error' => 'Subtask starting date cannot be later than its due date!']);
            }

            Subtask::where([['task_id', '=', $task_id], ['id', '=', $subtask_id]])->update([
                'title' => $title,
                'desc' => $desc,
                'start_datetime' => $start_datetime,
                'due_datetime' => $due_datetime,
                'priority' => $priority,
                'status' => $status,
            ]);

            return response()->json(['success' => "Successfully updated subtask {$subtask_id}"]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function destroy(Request $request) {
        try {
            ["subtaskid" => $subtask_id, "taskid" => $task_id] = $request;

            Subtask::where([['task_id', '=', $task_id], ['id', '=', $subtask_id]])->delete();

            return response()->json(['success' => "Successfully deleted subtask {$subtask_id}"]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }
}
