<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Throwable;
use DateTime;

class ProjectController extends Controller {
    public function getall() {
        try {
            $projects = Project::get();
            return response()->json(['projects' => $projects], 200);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function getone(Request $request) {
        try {
            ['id' => $id] = $request;
            [$project] = Project::where('id', '=', $id)->get();
            [$personInCharge] = $project->getManager()->select('firstname', 'lastname')->get();
            $projectAssignees = $project->getAssignees()->select('firstname', 'lastname')->get();
            return response()->json(['project' => $project, 'person_in_charge' => $personInCharge, 'assignees' => $projectAssignees], 200);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function create(Request $request) {
        try {
            ['user_id' => $user_id, 'title' => $title, 'desc' => $desc, 'start_datetime' => $start_datetime, 'due_datetime' => $due_datetime, 'priority' => $priority, 'status' => $status] = $request;

            if (empty($title) && empty($desc) && empty($start_datetime) && empty($due_datetime) && empty($user_id)) {
                return response()->json(['error' => 'Missing required information!']);
            }

            if (new DateTime($start_datetime) >= new DateTime($due_datetime)) {
                return response()->json(['error' => 'Project starting date cannot be later than its due date!']);
            }

            $project = Project::create([
                'user_id' => $user_id,
                'title' => $title,
                'desc' => $desc,
                'start_datetime' => $start_datetime,
                'due_datetime' => $due_datetime,
                'priority' => $priority,
                'status' => $status
            ]);

            return response()->json(['success' => "Successfully created project {$project->title}!"]);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function update(Request $request) {
        try {
            ['id' => $id, 'user_id' => $user_id, 'title' => $title, 'desc' => $desc, 'start_datetime' => $start_datetime, 'due_datetime' => $due_datetime, 'priority' => $priority, 'status' => $status] = $request;

            if (empty($title) && empty($desc) && empty($start_datetime) && empty($due_datetime) && empty($user_id)) {
                return response()->json(['error' => 'Missing required information!']);
            }

            if (new DateTime($start_datetime) >= new DateTime($due_datetime)) {
                return response()->json(['error' => 'Project starting date cannot be later than its due date!']);
            }

            Project::where('id', '=', $id)->update([
                'user_id' => $user_id,
                'title' => $title,
                'start_datetime' => $start_datetime,
                'due_datetime' => $due_datetime,
                'priority' => $priority,
                'status' => $status
            ]);

            return response()->json(['success' => "Successfully updated project {$id}"]);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }

    public function destroy(Request $request) {
        try {
            ['id' => $id] = $request;
            Project::where('id', '=', $id)->delete();
            return response()->json(['success' => "Successfully deleted project {$id}"]);
        } catch (Throwable $err) {
            return response()->json($err, 400);
        }
    }
}
