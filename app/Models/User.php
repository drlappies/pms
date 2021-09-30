<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    use HasFactory;
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'email_address', 'firstname', 'lastname', 'is_employee', 'icon_url', 'icon_key'];
};
