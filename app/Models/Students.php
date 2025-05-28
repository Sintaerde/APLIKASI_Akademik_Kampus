<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class Students extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'student_id',
        'name',
        'email',
        'NIM',
        'major',
        'enrollment_year',
        'password'
    ];

    protected $hidden = ['password'];
}
