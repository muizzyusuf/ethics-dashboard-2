<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consequence extends Model
{
    use HasFactory;

    public function option(){
        return $this->belongsTo('App\Models\Option', 'id');
    }

    public function pleasures(){
        return $this->hasMany('App\Models\Pleasure');
    }
}
