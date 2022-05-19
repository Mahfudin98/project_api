<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessKey extends Model
{
    use HasFactory;
    protected $table = 'user_access_key';
}
