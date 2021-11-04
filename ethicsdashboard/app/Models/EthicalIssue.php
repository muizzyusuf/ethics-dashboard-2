<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EthicalIssue extends Model
{
    use HasFactory;

    public function dashboard(){
        return $this->belongsTo('App\Models\Dashboard');
    }

    public function options(){
        return $this->hasMany('App\Models\Option');
    }

}
