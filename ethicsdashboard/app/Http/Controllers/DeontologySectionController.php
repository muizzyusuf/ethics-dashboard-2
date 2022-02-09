<?php

namespace App\Http\Controllers;

use App\Models\DeontologySection;
use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\CaseStudy;
use App\Models\Stakeholder;
use App\Models\StakeholderSection;
use App\Models\Care;
use App\Models\Option;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DeontologySectionController extends Controller
{
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
     * @param  \App\Models\DeontologySection  $deontologySection
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $deontologySection = DeontologySection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$deontologySection->dashboard->id)->first();        
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();
       
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeontologySection  $deontologySection
     * @return \Illuminate\Http\Response
     */
    public function edit(DeontologySection $deontologySection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeontologySection  $deontologySection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeontologySection $deontologySection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeontologySection  $deontologySection
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeontologySection $deontologySection)
    {
        //
    }
    public function comment(Request $request, $id)
    { 

        $deontology = DeontologySection::where('id', $id)->first();
        $deontology->comment = $request->input('comment');
        $deontology->grade = $request->input('grade');
        $deontology->save();


        $dashboard = Dashboard::where('id', $deontology->dashboard->id)->first();
        $egrade = $dashboard->ethicalIssue->grade;
        $sgrade = $dashboard->stakeholderSection->grade;
        $ugrade = $dashboard->utilitarianismSection->grade;
        $dgrade = $dashboard->deontologySection->grade;
        $dashboard->grade = $egrade + $sgrade +$ugrade +dgrade;


        if($dashboard->save()){
            $request->session()->flash('success', 'Comment and grade saved');
        }else{
            $request->session()->flash('error', 'There was an error saving the comment and grade');
        }
        return  redirect()->back();
    }

    public function summary($id)
    {
     
        $deontologySection = DeontologySection::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$deontologySection->dashboard->id)->first();        
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();

       

        if(Auth::user()->role()->first()->id == 3){
            return view('student.deontology_summary')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('deontologySection', $deontologySection);
                                       
        }else{
            return view('deontology_summary')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('deontologySection', $DeontologySection);
        }
        
        

       
    }
}
