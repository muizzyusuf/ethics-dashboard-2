<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'name', 
        'instruction', 
        'issue_points',
        'stakeholder_points',
        'util_points',
        'deontology_points',
        'virtue_points',
        'care_points',
        'points',
        'course_id',
    ];

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

    public function dashboard(){
        return $this->hasMany('App\Models\Dashboard');
    }
}
