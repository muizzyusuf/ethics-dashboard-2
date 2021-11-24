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

class ProgressController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $dashboard = Dashboard::where('id',$id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $stakeholderSection = StakeholderSection::where('id', $dashboard->stakeholder_section_id)->first();
        $utilitarianismSection = UtilitarianismSection::where('id', $dashboard->utilitarianism_section_id)->first();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)->get();
        return view('progress')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholderSection', $stakeholderSection)
                                ->with('casestudy', $casestudy)
                                ->with('utilitarianismSection', $utilitarianismSection)
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
