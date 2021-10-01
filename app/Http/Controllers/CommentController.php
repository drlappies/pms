<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;
use App\Models\Comment;

class CommentController extends Controller {
    public function getall(Request $request) {
        try {
            ['taskid' => $task_id] = $request;
            $comments = Comment::with('author:id,firstname,lastname', 'taggedUser:id,firstname,lastname', 'task', 'taggedSubtask')->where('task_id', '=', $task_id)->get();
            return response()->json(['comments' => $comments]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function getone(Request $request) {
        try {
            ['taskid' => $task_id, 'commentid' => $comment_id] = $request;
            [$comment] = Comment::where([['task_id', '=', $task_id], ['id', '=', $comment_id]])->get();
            [$author] = $comment->author()->select('id', 'firstname', 'lastname')->get();
            $parentTask = $comment->task()->get();
            $taggedUser = $comment->taggedUser()->select('id', 'firstname', 'lastname')->get();
            $taggedSubtask = $comment->taggedSubtask()->get();
            return response()->json(['comment' => $comment, 'author' => $author, 'task' => $parentTask, 'tagged_user' => $taggedUser, 'tagged_subtask' => $taggedSubtask]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function create(Request $request) {
        try {
            ['taskid' => $task_id, 'tagged_user_id' => $tagged_user_id, 'tagged_subtask_id' => $tagged_subtask_id, 'comment' => $comment, 'author_id' => $author_id] = $request;

            Comment::create([
                'author_id' => $author_id,
                'task_id' => $task_id,
                'tagged_user_id' => $tagged_user_id,
                'tagged_subtask_id' => $tagged_subtask_id,
                'comment' => $comment
            ]);

            return response()->json(['success' => "Successfully created comment"]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function update(Request $request) {
        try {
            ['taskid' => $task_id, 'commentid' => $comment_id, 'tagged_user_id' => $tagged_user_id, 'tagged_subtask_id' => $tagged_subtask_id, 'comment' => $comment] = $request;

            Comment::where([['task_id', '=', $task_id], ['id', '=', $comment_id]])->update([
                'tagged_user_id' => $tagged_user_id,
                'tagged_subtask_id' => $tagged_subtask_id,
                'comment' => $comment
            ]);

            return response()->json(['success' => "Successfully updated comment"]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }

    public function delete(Request $request) {
        try {
            ['taskid' => $task_id, 'commentid' => $comment_id,] = $request;
            Comment::where([['task_id', '=', $task_id], ['id', '=', $comment_id]])->delete();
            return response()->json(['success' => "Successfully deleted comment"]);
        } catch (Throwable $err) {
            return response($err, 400);
        }
    }
}
