<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    public function ethicalIssue(){
        return $this->belongsTo('App\Models\EthicalIssue', 'id');
    }

    public function consequences(){
        return $this->hasMany('App\Models\Consequence','option_id');
    }

    public function pleasures(){
        return $this->hasMany('App\Models\Pleasure');
    }
}
