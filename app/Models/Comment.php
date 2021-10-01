<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = ['author_id', 'task_id', 'tagged_user_id', 'tagged_subtask_id', 'comment'];

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function taggedUser() {
        return $this->belongsTo(User::class);
    }

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function taggedSubtask() {
        return $this->belongsTo(Subtask::class);
    }
}
