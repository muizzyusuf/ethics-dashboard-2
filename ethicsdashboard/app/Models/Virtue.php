<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virtue extends Model
{
    use HasFactory;

    public function option(){
        return $this->hasOne('App\Models\Option', 'virtue_id');
    }

    public function stakeholder(){
        return $this->hasOne('App\Models\Stakeholder', 'virtue_id');
    }
}
