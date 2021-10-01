<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    use HasFactory;
    public $timestamps = false;
    protected $table = 'task';
    protected $fillable = ['title', 'desc', 'start_datetime', 'due_datetime', 'priority', 'status', 'project_id'];
    public function assignee() {
        return $this->belongsToMany(User::class);
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function subtask() {
        return $this->hasMany(Subtask::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'task_id');
    }
}
