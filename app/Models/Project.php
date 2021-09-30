<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;
    protected $table = 'project';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
    public $timestamps = false;
    protected $fillable = ['user_id', 'title', 'desc', 'start_datetime', 'due_datetime', 'priority', 'status'];
    public function getManager() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAssignees() {
        return $this->belongsToMany(User::class);
    }
}
