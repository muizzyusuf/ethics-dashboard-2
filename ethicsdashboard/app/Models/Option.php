<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    
    use HasFactory;
    protected $fillable = [
        'ethicalIssue',
        'option1', 
        'option2', 
        'option3', 
        'option4',
    ];

    use HasFactory;

    public function ethicalIssue(){
        return $this->belongsTo('App\Models\EthicalIssue');
    }

    public function consequences(){
        return $this->hasMany('App\Models\Consequence');
    }

    public function pleasures(){
        return $this->hasMany('App\Models\Pleasure');
    }
}
