<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'f_name', 'l_name', 'user_name', 'role','phone','email', 'address', 'division_id', 'district_id',
        'blood_group','age', 'photo', 'gender','password'
    ];
}
