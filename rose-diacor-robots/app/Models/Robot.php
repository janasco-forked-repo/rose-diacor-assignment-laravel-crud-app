<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    use HasFactory;
    protected $fillable = [
        'robot_name',
        'robot_desc',
        'robot_creator',
        'robot_country',
        'robot_year',
        'robot_type',
        'robot_image'
    ];
}