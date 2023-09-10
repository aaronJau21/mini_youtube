<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use Authenticatable;
    use HasFactory;
    use HasApiTokens;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'image',
        'role'
    ];

    protected $casts = ['role' => UserRoleEnum::class];
}
