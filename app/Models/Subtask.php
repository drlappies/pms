<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model {
    use HasFactory;
    protected $table = 'subtask';
    public $timestamps = false;
    protected $fillable = ['task_id', 'title', 'desc', 'start_datetime', 'due_datetime', 'priority', 'status'];

    public function task() {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function taggedComment() {
        return $this->hasMany(Comment::class, 'tagged_subtask_id');
    }
}
