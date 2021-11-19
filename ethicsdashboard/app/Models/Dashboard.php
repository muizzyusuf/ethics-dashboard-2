<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'name', 
        'ethical_issue_id', 
        'utilitarianism_section_id',
        'user_id',
        'case_study_id'
    ];
    public function ethicalIssue(){
        return $this->hasOne('App\Models\EthicalIssue');
    }

    public function utilitarianismSection(){
        return $this->hasOne('App\Models\UtilitarianismSection');
    }

    public function stakeholderSection(){
        return $this->hasOne('App\Models\StakeholderSection');
    }

    public function caseStudy(){
        return $this->belongsTo('App\Models\CaseStudy');
    }

    public function user(){ 
        return $this->belongsTo('App\Models\User');
    }
}
