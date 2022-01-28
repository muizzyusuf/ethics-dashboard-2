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

        if(Auth::user()->role()->first()->id == 3){
            return view('student.careethics')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('careSection', $careSection);

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
}
