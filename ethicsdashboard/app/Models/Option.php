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

    public function motivations(){
        return $this->hasMany('App\Models\Motivation','option_id');
    }

    public function pleasures(){
        return $this->hasMany('App\Models\Pleasure', 'option_id');
    }

    public function virtue(){
        return $this->belongsTo('App\Models\Virtue', 'virtue_id');
    }

    public function cares(){
        return $this->hasMany('App\Models\Care', 'option_id');
    }

    public function moralLaws(){
        return $this->hasMany('App\Models\MoralLaw', 'option_id');
    }

    public function moralIssue(){
        return $this->hasOne('App\Models\MoralIssue', 'option_id');
    }

}
