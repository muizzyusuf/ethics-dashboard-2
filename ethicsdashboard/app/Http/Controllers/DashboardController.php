<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

use App\Models\EthicalIssue;
use App\Models\StakeholderSection;
use App\Models\UtilitarianismSection;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{   public function index($case_study_id){
        $array=array(
            'case_study_id'=>$case_study_id
        );
        return view('dashboard')->with($array);
}
    public function store(Request $request, $case_study_id)
    {
        //
        
        $id = Auth::user()->id;
        /*'id', 
        'name', 
        'ethical_issue_id', 
        'utilitarianism_section_id',
        'user_id',
        'case_study_id'
        */
        
        $issue = new EthicalIssue;
        $issue->save(); //generates the id and sets grade,comment,issue to null
        $stakeholder = new StakeholderSection;
        $stakeholder->save(); //generates the id and sets grade,comment to null
        $util = new UtilitarianismSection;
        $util->save(); //generates the id and sets grade,comment to null

        $dash = new Dashboard;
        $dash->name = $request->input('name'); //gotten from create dashboard form as input
        $dash->user_id = $id; //gotten from create dashboard form as hidden input
        $dash->case_study_id = $case_study_id; //gotten from create dashboard form as hidden input
        $dash->ethical_issue_id = $issue->id;
        $dash->stakeholder_section_id = $stakeholder->id;
        $dash->utilitarianism_section_id = $util->id;
        $dash->save();
        
        if($dash->save()){
            $request->session()->flash('success', 'New Dashboard Created');
        }else{
            $request->session()->flash('error', 'There was an error creating the dashboard');
        }


        return redirect('/home');
    }
}
