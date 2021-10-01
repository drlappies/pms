<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;
    protected $table = 'project';
    protected $fillable = ['user_id', 'title', 'desc', 'start_datetime', 'due_datetime', 'priority', 'status'];
    public function manager() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignee() {
        return $this->belongsToMany(User::class);
    }

    public function task() {
        return $this->hasMany(Task::class);
    }
}
