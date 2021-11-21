<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    use HasFactory;
    
    public $fillable = ['stakeholder', 'interests', 'stakeholder_section_id'];

    public function stakeholderSection(){
        return $this->belongsTo('App\Models\StakeholderSection');
    }

    public function impact(){
        return $this->hasOne('App\Models\Impact');
    }

    public function pleasures(){
        return $this->hasMany('App\Models\Pleasure');
    }
}
