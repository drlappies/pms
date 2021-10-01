<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    use HasFactory;
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'email_address', 'firstname', 'lastname', 'is_employee', 'icon_url', 'icon_key'];
    public function project() {
        return $this->hasMany(Project::class);
    }

    public function assignee() {
        return $this->belongsToMany(Project::class);
    }

    public function task() {
        return $this->belongsToMany(Project::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function taggedComment(){
        return $this->hasMany(Comment::class, 'tag_user_id');
    }
};
