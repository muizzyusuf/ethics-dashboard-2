<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtueSection extends Model
{
    use HasFactory;

    public function dashboard(){
        return $this->belongsTo('App\Models\Dashboard', 'id');
    }
}
