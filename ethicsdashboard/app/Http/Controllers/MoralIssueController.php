<?php

namespace App\Http\Controllers;

use App\Models\MoralIssue;
use Illuminate\Http\Request;
use App\Models\Option;

class MoralIssueController extends Controller
{
    //
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
        $option = Option::where('id', $request->input('option_id'))->first();
        dd($request->input('option_id'));
        if($request->input('moral_issues_id')==null){
            $moral_issues = new MoralIssue;
            //$option->id =$moral_issues->option_id;
            $moral_issues->option_id = $option->id;
            $moral_issues->moral_issues = $request->input('moral_issues');

            $moral_issues->save();
            //set eloquent relationships
            $moral_issues->option()->associate($option);

            if($moral_issues->option()->associate($option)){
                $request->session()->flash('success', 'Moral Issues saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the moral issues');
            }
            return  redirect()->back();

        }else{
            $moral_issues = moralissue::where('id', $request->input('moral_issues') )->first();
            $moral_issues->moral_issues = $request->input('moral_issues');
            $moral_issues->save();

            if($moral_issues->save()){
                $request->session()->flash('success', 'Moral Issues saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the moral issues');
            }
            return  redirect()->back();
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
