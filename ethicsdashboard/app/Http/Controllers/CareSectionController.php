<?php

namespace App\Http\Controllers;

use App\Models\CareSection;
use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\CaseStudy;
use App\Models\Option;
use App\Models\Stakeholder;
use App\Models\StakeholderSection;
use App\Models\Care;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CareSectionController extends Controller
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
     * @param  \App\Models\CareSection  $careSection
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
        $careSection = CareSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$careSection->dashboard->id)->first();        
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();
        /*
        $cares=array();
        for($i=0; $i<count($stakeholders); $i++){
            $careOld=Care::where('stakeholder_id',$stakeholders[$i]->id)->get();
            if ($careOld!=null){
            array_push($cares, $careOld);
            }
            else array_push($cares,new Care);
        }
        */


        $cares = Care::join('options','cares.option_id','=','options.id')
        ->select('cares.id','cares.attentiveness','cares.competence','cares.responsiveness','cares.stakeholder_id','cares.option_id')
        ->where('options.ethical_issue_id', $ethicalissue->id)->get();

        if(Auth::user()->role()->first()->id == 3){
            return view('student.careethics')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('careSection', $careSection)
                                ->with('cares', $cares);

        }else{
            return view('careethics')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('careSection', $careSection);
        }
        
        

       
    }


    public function summary($id)
    {
     
        $careSection = CareSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$careSection->dashboard->id)->first();        
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();

        $cares = Care::join('options','cares.option_id','=','options.id')
        ->select('cares.id','cares.attentiveness','cares.competence','cares.responsiveness','cares.stakeholder_id','cares.option_id')
        ->where('options.ethical_issue_id', $ethicalissue->id)->get();


        if(Auth::user()->role()->first()->id == 3){
            return view('student.care_summary')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('careSection', $careSection)
                                ->with('cares', $cares);

        }else{
            return view('care_summary')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('careSection', $careSection);
        }
        
        

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CareSection  $careSection
     * @return \Illuminate\Http\Response
     */
    public function edit(CareSection $careSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CareSection  $careSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CareSection $careSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareSection  $careSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareSection $careSection)
    {
        //
    }

    public function comment(Request $request, $id)
    { 
        //
        $care = CareSection::where('id', $id)->first();
        $care->comment = $request->input('comment');
        $care->grade = $request->input('grade');
        $care->save();


        $dashboard = Dashboard::where('id', $care->dashboard->id)->first();
        $egrade = $dashboard->ethicalIssue->grade;
        $sgrade = $dashboard->stakeholderSection->grade;
        $ugrade = $dashboard->utilitarianismSection->grade;
        $cgrade = $dashboard->careSection->grade;
        $dashboard->grade = $egrade + $sgrade +$ugrade + $cgrade;


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
        $care = CareSection::where('id', $id)->first();
        $care->decision = $request->input('decision');

        if( $care->save()){
            $request->session()->flash('success', 'Decision saved');
        }else{
            $request->session()->flash('error', 'There was an error saving the decision');
        }
        return  redirect()->back();
    }
}
