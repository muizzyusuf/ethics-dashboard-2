<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoralIssue extends Model
{
    use HasFactory;

    public function option(){
        return $this->belongsTo('App\Models\Option', 'id');
    }

}
