<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\CaseStudy;
use App\Models\Option;
use App\Models\Stakeholder;
use App\Models\StakeholderSection;


class StakeholderSectionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {

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

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request, $id)
    {

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
        $ethicalissue = EthicalIssue::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$ethicalissue->dashboard->id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)-> get();
        $stakeholderSection = StakeholderSection::where('id', $dashboard->stakeholder_section_id)->first();

        
        return view('stakeholder')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('stakeholderSection', $stakeholderSection);

        
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
        
    }

    public function comment(Request $request, $id)
    { 
        //
        $stakeholder = StakeholderSection::where('id', $id)->first();
        $stakeholder->comment = $request->input('comment');
        $stakeholder->grade = $request->input('grade');
        $stakeholder->save();


        $dashboard = Dashboard::where('id', $stakeholder->dashboard->id)->first();
        $egrade = $dashboard->ethicalIssue->grade;
        $sgrade = $dashboard->stakeholderSection->grade;
        $dashboard->grade = $egrade + $sgrade;


        if($dashboard->save()){
            $request->session()->flash('success', 'Comment and grade saved');
        }else{
            $request->session()->flash('error', 'There was an error saving the comment and grade');
        }
        return  redirect(route('stakeholdersection.show', $id));
    }
}
