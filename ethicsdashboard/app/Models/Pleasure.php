<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pleasure extends Model
{
    use HasFactory;

    public function consequence(){
        return $this->belongsTo('App\Models\Consequence');
    }

    public function stakeholder(){
        return $this->belongsTo('App\Models\Stakeholder');
    }

    public function option(){
        return $this->belongsTo('App\Models\Option');
    }
}
