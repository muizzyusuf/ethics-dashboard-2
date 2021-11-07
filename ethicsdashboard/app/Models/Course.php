<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'title', 
        'code', 
        'number',
        'section',
        'year'
    ];

    public function users(){
        return $this->belongsToMany('App\Model\User', 'course_users', 'course_id', 'user_id');
    }

    public function assignments(){
        return $this->hasMany('App\Models\Assignment');
    }
}
