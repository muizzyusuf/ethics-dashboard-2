<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

    public function courses(){
        return this->belongsTo('App\Models\Course');
    }

    public function dashboard(){
        return $this->hasMany('App\Models\Dashboard');
    }
}
