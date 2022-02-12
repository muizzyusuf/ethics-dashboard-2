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
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();   
        

        // for each option assign a virtue_id (so assigbn general id of the virtue to the options)
        //make arrays of virtues outside then 
        $virtues = []; 
        foreach($options as $option){
            $virtue = new Virtue;
            array_push($virtues, $virtue);
            $option -> virtue_id = $virtue -> id;
        }

      
        if(Auth::user()->role()->first()->id == 3){
            return view('student.virtueethics')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('virtueSection', $virtueSection)
                                ->with('virtues', $virtues);

        }else{
            return view('virtueethics')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options)
                                ->with('virtueSection', $virtueSection);
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
}

