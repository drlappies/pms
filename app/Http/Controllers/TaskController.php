<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Throwable;
use DateTime;

class TaskController extends Controller {
    public function getall(Request $request) {
        try {
            ['projectid' => $project_id] = $request;
            $tasks = Task::with('project', 'assignee')->where('project_id', '=', $project_id)->get();
            return response()->json(['tasks' => $tasks], 200);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function getone(Request $request) {
        try {
            ['id' => $id] = $request;
            [$task] = Task::where('id', '=', $id)->get();
            [$project] = $task->project()->get();
            return response()->json(['tasks' => $task, 'parent_project' => $project], 200);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function create(Request $request) {
        try {
            ['projectid' => $project_id, 'title' => $title, 'desc' => $desc, 'start_datetime' => $start_datetime, 'due_datetime' => $due_datetime, 'priority' => $priority, 'status' => $status] = $request;

            if (empty($title) && empty($desc) && empty($start_datetime) && empty($due_datetime)) {
                return response()->json(['error' => 'Missing required information!']);
            }

            if (new DateTime($start_datetime) >= new DateTime($due_datetime)) {
                return response()->json(['error' => 'Project starting date cannot be later than its due date!']);
            }

            $task = Task::create([
                'project_id' => $project_id,
                'title' => $title,
                'desc' => $desc,
                'start_datetime' => $start_datetime,
                'due_datetime' => $due_datetime,
                'priority' => $priority,
                'status' => $status
            ]);

            return response()->json(['success' => "Successfully created task {$task->title}"], 200);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function update(Request $request) {
        try {
            ['projectid' => $project_id, 'id' => $id, 'title' => $title, 'desc' => $desc, 'start_datetime' => $start_datetime, 'due_datetime' => $due_datetime, 'priority' => $priority, 'status' => $status] = $request;

            if (empty($title) && empty($desc) && empty($start_datetime) && empty($due_datetime)) {
                return response()->json(['error' => 'Missing required information!']);
            }

            if (new DateTime($start_datetime) >= new DateTime($due_datetime)) {
                return response()->json(['error' => 'Project starting date cannot be later than its due date!']);
            }

            Task::where([['id', '=', $id], ['project_id', '=', $project_id]])->update([
                'title' => $title,
                'desc' => $desc,
                'start_datetime' => $start_datetime,
                'due_datetime' => $due_datetime,
                'priority' => $priority,
                'status' => $status
            ]);

            return response()->json(['success' => "Successfully updated task {$id}"], 200);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function destroy(Request $request) {
        try {
            ['projectid' => $project_id, 'id' => $id] = $request;
            Task::where([['id', '=', $id], ['project_id', '=', $project_id]])->delete();
            return response()->json(['success' => "Successfully deleted task {$id}"]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }
}
