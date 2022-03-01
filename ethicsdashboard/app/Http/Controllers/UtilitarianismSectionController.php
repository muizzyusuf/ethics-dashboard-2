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
use App\Models\UtilitarianismSection;
use App\Models\Consequence;
use App\Models\Impact;
use App\Models\Pleasure;


class UtilitarianismSectionController extends Controller
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

        $utilitarianismSection = UtilitarianismSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$utilitarianismSection->dashboard->id)->first();        
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();
        $impacts = Impact::join('stakeholders','impacts.stakeholder_id','=', 'stakeholders.id')
                        ->select('impacts.id','impacts.stakeholder_id','impacts.rank', 'impacts.impact')
                        ->where('Stakeholders.stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $consequences = Consequence::join('options','consequences.option_id','=','options.id')
                                ->select('consequences.id', 'consequences.consequence', 'consequences.type', 'consequences.option_id')
                                ->where('options.ethical_issue_id', $ethicalissue->id)->get();
        $pleasures = Pleasure::join('options','pleasures.option_id','=','options.id')
                            ->select('pleasures.id','pleasures.pleasure','pleasures.level','pleasures.explanation','pleasures.stakeholder_id','pleasures.option_id','pleasures.consequence_id')
                            ->where('options.ethical_issue_id', $ethicalissue->id)->get();

     

        if(Auth::user()->role()->first()->id == 3){
            return view('student.utilitarianism')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('consequences', $consequences)
                                ->with('impacts', $impacts)
                                ->with('pleasures', $pleasures)
                                ->with('utilitarianismSection', $utilitarianismSection);

        }else{
            return view('utilitarianism')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('consequences', $consequences)
                                ->with('impacts', $impacts)
                                ->with('pleasures', $pleasures)
                                ->with('utilitarianismSection', $utilitarianismSection);
        }
        
        

        
    }

    public function impact($id)
    {
        //

        $utilitarianismSection = UtilitarianismSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$utilitarianismSection->dashboard->id)->first();        
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();
        $impacts = Impact::join('stakeholders','impacts.stakeholder_id','=', 'stakeholders.id')
                        ->select('impacts.id','impacts.stakeholder_id','impacts.rank', 'impacts.impact')
                        ->where('Stakeholders.stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $consequences = Consequence::join('options','consequences.option_id','=','options.id')
                                ->select('consequences.id', 'consequences.consequence', 'consequences.type', 'consequences.option_id')
                                ->where('options.ethical_issue_id', $ethicalissue->id)->get();
        $pleasures = Pleasure::join('options','pleasures.option_id','=','options.id')
                            ->select('pleasures.id','pleasures.pleasure','pleasures.level','pleasures.explanation','pleasures.stakeholder_id','pleasures.option_id','pleasures.consequence_id')
                            ->where('options.ethical_issue_id', $ethicalissue->id)->get();


        if(Auth::user()->role()->first()->id == 3){
            return view('student.impact')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('consequences', $consequences)
                                ->with('impacts', $impacts)
                                ->with('pleasures', $pleasures)
                                ->with('utilitarianismSection', $utilitarianismSection);

        }else{
            return view('impact')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('consequences', $consequences)
                                ->with('impacts', $impacts)
                                ->with('pleasures', $pleasures)
                                ->with('utilitarianismSection', $utilitarianismSection);
        }
        
        

        
    }

    public function aggregate($id)
    {
        //

        $utilitarianismSection = UtilitarianismSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$utilitarianismSection->dashboard->id)->first();        
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();
        $impacts = Impact::join('stakeholders','impacts.stakeholder_id','=', 'stakeholders.id')
                        ->select('impacts.id','impacts.stakeholder_id','impacts.rank', 'impacts.impact')
                        ->where('Stakeholders.stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $consequences = Consequence::join('options','consequences.option_id','=','options.id')
                                ->select('consequences.id', 'consequences.consequence', 'consequences.type', 'consequences.option_id')
                                ->where('options.ethical_issue_id', $ethicalissue->id)->get();
        $pleasures = Pleasure::join('options','pleasures.option_id','=','options.id')
                            ->select('pleasures.id','pleasures.pleasure','pleasures.level','pleasures.explanation','pleasures.stakeholder_id','pleasures.option_id','pleasures.consequence_id')
                            ->where('options.ethical_issue_id', $ethicalissue->id)->get();


        if(Auth::user()->role()->first()->id == 3){
            return view('student.aggregate')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('consequences', $consequences)
                                ->with('impacts', $impacts)
                                ->with('pleasures', $pleasures)
                                ->with('utilitarianismSection', $utilitarianismSection);

        }else{
            return view('aggregate')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('consequences', $consequences)
                                ->with('impacts', $impacts)
                                ->with('pleasures', $pleasures)
                                ->with('utilitarianismSection', $utilitarianismSection);
        }
        
        

        
    }

    public function summary($id)
    {
        //

        $utilitarianismSection = UtilitarianismSection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$utilitarianismSection->dashboard->id)->first();        
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();
        $impacts = Impact::join('stakeholders','impacts.stakeholder_id','=', 'stakeholders.id')
                        ->select('impacts.id','impacts.stakeholder_id','impacts.rank', 'impacts.impact')
                        ->where('Stakeholders.stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $consequences = Consequence::join('options','consequences.option_id','=','options.id')
                                ->select('consequences.id', 'consequences.consequence', 'consequences.type', 'consequences.option_id')
                                ->where('options.ethical_issue_id', $ethicalissue->id)->get();
        $pleasures = Pleasure::join('options','pleasures.option_id','=','options.id')
                            ->select('pleasures.id','pleasures.pleasure','pleasures.level','pleasures.explanation','pleasures.stakeholder_id','pleasures.option_id','pleasures.consequence_id')
                            ->where('options.ethical_issue_id', $ethicalissue->id)->get();



        if(Auth::user()->role()->first()->id == 3){
            return view('student.util_summary')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('consequences', $consequences)
                                ->with('impacts', $impacts)
                                ->with('pleasures', $pleasures)
                                ->with('utilitarianismSection', $utilitarianismSection);

        }else{
            return view('util_summary')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('consequences', $consequences)
                                ->with('impacts', $impacts)
                                ->with('pleasures', $pleasures)
                                ->with('utilitarianismSection', $utilitarianismSection);
        }
        
        

        
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
        $util = UtilitarianismSection::where('id', $id)->first();
        $util->comment = $request->input('comment');
        $util->grade = $request->input('grade');
        $util->save();


        $dashboard = Dashboard::where('id', $util->dashboard->id)->first();
        $egrade = $dashboard->ethicalIssue->grade;
        $sgrade = $dashboard->stakeholderSection->grade;
        $ugrade = $dashboard->utilitarianismSection->grade;
        $cgrade = $dashboard->careSection->grade;
        $vgrade = $dashboard->virtueSection->grade;
        $dgrade = $dashboard->deontologySection->grade;
        $dashboard->grade = $egrade + $sgrade +$ugrade + $cgrade + $dgrade +$vgrade;
      

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
        $util = UtilitarianismSection::where('id', $id)->first();
        $util->decision = $request->input('decision');

        if( $util->save()){
            $request->session()->flash('success', 'Decision saved');
        }else{
            $request->session()->flash('error', 'There was an error saving the decision');
        }
        return  redirect()->back();
    }
}
