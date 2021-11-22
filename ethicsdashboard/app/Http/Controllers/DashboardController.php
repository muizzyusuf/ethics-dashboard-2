<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

use App\Models\EthicalIssue;
use App\Models\StakeholderSection;
use App\Models\UtilitarianismSection;
use App\Models\User;
use App\Models\CaseStudy;
use App\Models\Stakeholder;
use App\Models\Option;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $dash->case_study_id = $request->input('case_study_id'); //gotten from create dashboard form as hidden input
        $dash->ethical_issue_id = $issue->id;
        $dash->stakeholder_section_id = $stakeholder->id;
        $dash->utilitarianism_section_id = $util->id;
        $dash->save();

        //set eloquent relationships
        $dash->user()->associate(User::where('id',$id)->first());
        $dash->caseStudy()->associate(CaseStudy::where('id',$request->input('case_study_id')));
        $issue->dashboard()->associate($dash);
        $stakeholder->dashboard()->associate($dash);

        if($util->dashboard()->associate($dash)){
            $request->session()->flash('success', 'New Dashboard Created');
        }else{
            $request->session()->flash('error', 'There was an error creating the dashboard');
        }


        return redirect(route('casestudy.show', $request->input('case_study_id')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
        $dashboard = Dashboard::where('id',$id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)-> get();
        return view('dashboard')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $id = Auth::user()->id;
    
        $dash = Dashboard::where('id', $id)->first();
        $dash->name = $request->input('name'); //gotten from create dashboard form as input
        
        if($dash->save()){
            $request->session()->flash('success', 'New dashboard updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the dashboard');
        }


        return redirect(route('casestudy.show', $request->input('case_study_id')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $dashboard = Dashboard::where('id', $id)->first();
        
        if($dashboard->delete()){
            $request->session()->flash('success','Dashboard has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the dashboard');
        }
        
        return redirect(route('casestudy.show', $request->input('case_study_id')));
    }

}
