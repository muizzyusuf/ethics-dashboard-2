<?php

namespace App\Http\Controllers;

use App\Models\VirtueSection;
use Illuminate\Http\Request;
use App\Models\Virtue;
use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\CaseStudy;
use App\Models\Option;
use App\Models\Stakeholder;
use App\Models\StakeholderSection;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class VirtueSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        //
    }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

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
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VirtueSection  $virtueSection
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO
        $virtueSection = VirtueSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$virtueSection->dashboard->id)->first();   
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $dashboard->ethical_issue_id)->get();   

        // for each option assign a virtue_id (so assigbn general id of the virtue to the options)
        //make arrays of virtues outside then 
        
        $optionVirtues = Virtue::join('options','virtues.id','=','options.virtue_id')
        ->select('virtues.id','virtues.excess','virtues.mean','virtues.deficiency', 'virtues.value', 'virtues.virtue')
        ->where('options.ethical_issue_id', $dashboard->ethical_issue_id)->get();

        $stakeholderVirtues = Virtue::join('stakeholders','virtues.id','=','stakeholders.virtue_id')
        ->select('virtues.id','virtues.excess','virtues.mean','virtues.deficiency', 'virtues.value', 'virtues.virtue')
        ->where('stakeholders.stakeholder_section_id', $dashboard->stakeholder_section_id)->get();


        if(Auth::user()->role()->first()->id == 3){
            return view('student.virtueethics')->with('dashboard', $dashboard)
                                ->with('stakeholders', $stakeholders)
                                ->with('options', $options)
                                ->with('virtueSection', $virtueSection)
                                ->with('stakeholderVirtues', $stakeholderVirtues)
                                ->with('optionVirtues', $optionVirtues);

        }else{
            return view('virtueethics')->with('dashboard', $dashboard)
                                ->with('stakeholders', $stakeholders)
                                ->with('options', $options)
                                ->with('virtueSection', $virtueSection)
                                ->with('stakeholderVirtues', $stakeholderVirtues)
                                ->with('optionVirtues', $optionVirtues);
        }   
    }

    public function summary($id)
    {
     
        $virtueSection = VirtueSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$virtueSection->dashboard->id)->first();  

        $optionVirtues = Virtue::join('options','virtues.id','=','options.virtue_id')
        ->select('virtues.id', 'virtues.value', 'virtues.virtue')
        ->where('options.ethical_issue_id', $dashboard->ethical_issue_id)
        ->orderBy(DB::raw('ABS(value)'), 'asc')
        ->get();

        $stakeholderVirtues = Virtue::join('stakeholders','virtues.id','=','stakeholders.virtue_id')
        ->select('virtues.id', 'virtues.value', 'virtues.virtue')
        ->where('stakeholders.stakeholder_section_id', $dashboard->ethical_issue_id)
        ->orderBy(DB::raw('ABS(value)'), 'asc')
        ->get();


        if(Auth::user()->role()->first()->id == 3){
            return view('student.virtue_summary')->with('dashboard', $dashboard)
                                ->with('virtueSection', $virtueSection)
                                ->with('stakeholderVirtues', $stakeholderVirtues)
                                ->with('optionVirtues', $optionVirtues);

        }else{
            return view('virtue_summary')->with('dashboard', $dashboard)
                                ->with('virtueSection', $virtueSection)
                                ->with('stakeholderVirtues', $stakeholderVirtues)
                                ->with('optionVirtues', $optionVirtues);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VirtueSection  $virtueSection
     * @return \Illuminate\Http\Response
     */

    public function edit(VirtueSection $virtueSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VirtueSection  $virtueSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VirtueSection $virtueSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VirtueSection  $virtueSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(VirtueSection $virtueSection)
    {
        //
    }

    public function comment(Request $request, $id)
    { 
        //
        $virtue = VirtueSection::where('id', $id)->first();
        $virtue->comment = $request->input('comment');
        $virtue->grade = $request->input('grade');
        $virtue->save();


        $dashboard = Dashboard::where('id', $virtue->dashboard->id)->first();
        $egrade = $dashboard->ethicalIssue->grade;
        $sgrade = $dashboard->stakeholderSection->grade;
        $ugrade = $dashboard->utilitarianismSection->grade;
        $cgrade = $dashboard->careSection->grade;
        $vgrade = $dashboard->virtueSection->grade;
        $dashboard->grade = $egrade + $sgrade +$ugrade + $cgrade + $vgrade;


        if($dashboard->save()){
            $request->session()->flash('success', 'Comment and grade saved');
        }else{
            $request->session()->flash('error', 'There was an error saving the comment and grade');
        }
        return  redirect()->back();
    }
   
    public function decision(Request $request, $id)
    { 
        //
        $virtue = VirtueSection::where('id', $id)->first();
        $virtue->decision = $request->input('decision');

        if( $virtue->save()){
            $request->session()->flash('success', 'Decision saved');
        }else{
            $request->session()->flash('error', 'There was an error saving the decision');
        }
        return  redirect()->back();
    }

    public function character($id)
    {
     
        $virtueSection = VirtueSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$virtueSection->dashboard->id)->first();        

        if(Auth::user()->role()->first()->id == 3){
            return view('student.character')->with('dashboard', $dashboard);

        }else{
            return view('character')->with('dashboard', $dashboard);
  
        }
    }
    
}

