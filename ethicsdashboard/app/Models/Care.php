<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Care extends Model
{
    use HasFactory;

    public function stakeholder(){
        return $this->belongsTo('App\Models\Stakeholder', 'id');
    }

    public function option(){
        return $this->belongsTo('App\Models\Option', 'id');
    }
}
