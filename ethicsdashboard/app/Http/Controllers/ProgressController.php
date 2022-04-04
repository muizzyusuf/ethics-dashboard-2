<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

use App\Models\EthicalIssue;
use App\Models\StakeholderSection;
use App\Models\DeontologySection;
use App\Models\UtilitarianismSection;
use App\Models\CareSection;
use App\Models\VirtueSection;
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
        $ethicalissue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $stakeholderSection = StakeholderSection::where('id', $dashboard->stakeholder_section_id)->first();
        $utilitarianismSection = UtilitarianismSection::where('id', $dashboard->utilitarianism_section_id)->first();
        $careSection = CareSection::where('id', $dashboard->care_section_id)->first();
        $virtueSection = VirtueSection::where('id', $dashboard->virtue_section_id)->first();
        $deontologySection = DeontologySection::where('id', $dashboard->deontology_section_id)->first();
        
        return view('progress')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholderSection', $stakeholderSection)
                                ->with('utilitarianismSection', $utilitarianismSection)
                                ->with('virtueSection', $virtueSection)
                                ->with('deontologySection', $deontologySection)
                                ->with('careSection', $careSection);
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
