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

class EthicalIssueController extends Controller
{
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'issue' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            ]);

        $ethicalissue = EthicalIssue::where('id', $request->input('id'))->first();
        $ethicalissue->issue = $request->input('issue');
        $ethicalissue->save();

        if($request->input('option1_id')==null){
            $option1 = new Option;
            $option1->option = $request->input('option1');
            $option1->ethical_issue_id = $request->input('id');
            $option1->save();
            //set eloquent relationships
            $option1->ethicalIssue()->associate($ethicalissue);

            $option2 = new Option;
            $option2->option = $request->input('option2');
            $option2->ethical_issue_id = $request->input('id');
            $option2->save();
            //set eloquent relationships
            $option2->ethicalIssue()->associate($ethicalissue);

            $option3 = new Option;
            $option3->option = $request->input('option3');
            $option3->ethical_issue_id = $request->input('id');
            $option3->save();
            //set eloquent relationships

            if($option3->ethicalIssue()->associate($ethicalissue)){
                $request->session()->flash('success', 'Ethical issues and options saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the ethical issues and options');
            }
            return  redirect(route('ethicalissue.show', $request->input('id')));

        }else{
            $option1 = Option::where('id', $request->input('option1_id'))->first();
            $option1->option = $request->input('option1');
            $option1->save();

            $option2 = Option::where('id', $request->input('option2_id'))->first();
            $option2->option = $request->input('option2');
            $option2->save();

            $option3 = Option::where('id', $request->input('option3_id'))->first();
            $option3->option = $request->input('option3');
            

            if($option3->save()){
                $request->session()->flash('success', 'Ethical issues and options updated');
            }else{
                $request->session()->flash('error', 'There was an error updating the ethical issues and options');
            }
            return  redirect(route('ethicalissue.show', $request->input('id')));
        }    
       
    
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
        $ethicalissue = EthicalIssue::where('id', $id)->first();
        $dashboard = Dashboard::where('id',$ethicalissue->dashboard->id)->first();
        $casestudy = CaseStudy::where('id', $dashboard->case_study_id)->first();
        
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $options = Option::where('ethical_issue_id', $ethicalissue->id)-> get();

        if(Auth::user()->role()->first()->id == 3){
            return view('student.ethicalissue')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options);
        }else{
            return view('ethicalissue')->with('dashboard', $dashboard)
                                ->with('ethicalissue', $ethicalissue)
                                ->with('stakeholders', $stakeholders)
                                ->with('casestudy', $casestudy)
                                ->with('options', $options);
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
        $ethicalissue = EthicalIssue::where('id', $id)->first();
        $ethicalissue->comment = $request->input('comment');
        $ethicalissue->grade = $request->input('grade');
        $ethicalissue->save();

        $dashboard = Dashboard::where('id', $ethicalissue->dashboard->id)->first();
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
        return  redirect(route('ethicalissue.show', $id));
    }
}
