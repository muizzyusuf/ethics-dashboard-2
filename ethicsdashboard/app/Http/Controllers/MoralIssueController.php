<?php

namespace App\Http\Controllers;

use App\Models\MoralIssue;
use Illuminate\Http\Request;
use App\Models\Option;

class MoralIssueController extends Controller
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
        $option = Option::where('id', $request->input('option_id'))->first();
        if($request->input('moral_issues')==null){
            $moralIssue = new MoralIssue;
            $moralIssue->option_id = $option->id;
            $moralIssue->moral_issues = $request->input('moral_issues');

            $moralIssue->save();
            //set eloquent relationships
            $moralIssue->option()->associate($option);

        }else{
            $moralIssue = moralIssue::where('id', $request->input('moral_issues') )->first();
            $moralIssue->moral_issues = $request->input('moral_issues');
            $moralIssue->save();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MoralIssue  $moralIssue
     * @return \Illuminate\Http\Response
     */
    public function show(MoralIssue $moralIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MoralIssue  $moralIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(MoralIssue $moralIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MoralIssue  $moralIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MoralIssue $moralIssue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MoralIssue  $moralIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy(MoralIssue $moralIssue)
    {
        //
    }
}
