<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    use HasFactory;
    
    public $fillable = ['stakeholder', 'interests', 'stakeholder_section_id'];

    public function stakeholderSection(){
        return $this->belongsTo('App\Models\StakeholderSection', 'id');
    }

    public function virtue(){
        return $this->belongsTo('App\Models\Virtue', 'virtue_id');
    }

    public function impact(){
        return $this->hasOne('App\Models\Impact', 'stakeholder_id');
    }

    public function pleasures(){
        return $this->hasMany('App\Models\Pleasure', 'stakeholder_id');
    }

    public function cares(){
        return $this->hasMany('App\Models\Care', 'stakeholder_id');
    }
}
