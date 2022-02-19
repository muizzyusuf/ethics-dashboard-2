<?php

namespace App\Http\Controllers;

use App\Models\MoralIssue;
use App\Models\MoralLaw;
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
        //dd($request->input('option_id'));

        $this->validate($request, [
            'moral_issue' => 'required',
            'morallaw1'  => 'required',
            'morallaw2'  => 'required',
            'morallaw3'  => 'required',

            ]);

        if($option->moralIssue != null ){

            $moralIssue = MoralIssue::where('id', $request->input('moral_issue_id'))->first();
            $moralIssue->moral_issues = $request->input('moral_issue');
            $moralIssue->save();

            $morallaw1 = MoralLaw::where('id',$request->input('morallaw1_id'))->first();
            $morallaw1->moral_law = $request->input('morallaw1');
            $morallaw1->save();

            $morallaw2 = MoralLaw::where('id',$request->input('morallaw2_id'))->first();
            $morallaw2->moral_law = $request->input('morallaw2');
            $morallaw2->save();

            $morallaw3 = MoralLaw::where('id',$request->input('morallaw3_id'))->first();
            $morallaw3->moral_law = $request->input('morallaw3');
            
            if($morallaw3->save()){
                $request->session()->flash('success', 'Motivations saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the motivations');
            }

        }else{

            $moralIssue = new MoralIssue;
            $moralIssue->moral_issues = $request->input('moral_issue');
            $moralIssue->option_id = $request->input('option_id');
            $moralIssue->save();
            $moralIssue->option()->associate($option);

            $morallaw1 = new MoralLaw;
            $morallaw1->moral_law = $request->input('morallaw1');
            $morallaw1->option_id = $request->input('option_id');
            $morallaw1->save();
            $morallaw1->option()->associate($option);

            $morallaw2 = new MoralLaw;
            $morallaw2->moral_law = $request->input('morallaw2');
            $morallaw2->option_id = $request->input('option_id');
            $morallaw2->save();
            $morallaw2->option()->associate($option);

            $morallaw3 = new MoralLaw;
            $morallaw3->moral_law = $request->input('morallaw3');
            $morallaw3->option_id = $request->input('option_id');
            $morallaw3->save();

            if($morallaw3->option()->associate($option)){
                $request->session()->flash('success', 'Motivations saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the motivations');
            }

        }

        return  redirect()->back();
        


        // if($request->input('moral_issues_id')==null){
        //     $moral_issues = new MoralIssue;
        //     //$option->id =$moral_issues->option_id;
        //     $moral_issues->option_id = $option->id;
        //     $moral_issues->moral_issues = $request->input('moral_issues');

        //     $moral_issues->save();
        //     //set eloquent relationships
        //     $moral_issues->option()->associate($option);

        //     if($moral_issues->option()->associate($option)){
        //         $request->session()->flash('success', 'Moral Issues saved');
        //     }else{
        //         $request->session()->flash('error', 'There was an error saving the moral issues');
        //     }
        //     return  redirect()->back();

        // }else{
        //     $moral_issues = moralissue::where('id', $request->input('moral_issues') )->first();
        //     $moral_issues->moral_issues = $request->input('moral_issues');
        //     $moral_issues->save();

        //     if($moral_issues->save()){
        //         $request->session()->flash('success', 'Moral Issues saved');
        //     }else{
        //         $request->session()->flash('error', 'There was an error saving the moral issues');
        //     }
        //     return  redirect()->back();
        // }
        
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
