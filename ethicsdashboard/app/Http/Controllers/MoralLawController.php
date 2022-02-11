<?php

namespace App\Http\Controllers;

use App\Models\MoralLaw;
use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\CaseStudy;
use App\Models\Option;
use App\Models\MoralIssue;
use App\Models\DeontologySection;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MoralLawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  index($id)
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
     * @param  \App\Models\MoralLaw  $moralLaw
     * @return \Illuminate\Http\Response
     */
    public function show(MoralLaw $moralLaw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MoralLaw  $moralLaw
     * @return \Illuminate\Http\Response
     */
    public function edit(MoralLaw $moralLaw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MoralLaw  $moralLaw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MoralLaw $moralLaw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MoralLaw  $moralLaw
     * @return \Illuminate\Http\Response
     */
    public function destroy(MoralLaw $moralLaw)
    {
        //
    }
}
