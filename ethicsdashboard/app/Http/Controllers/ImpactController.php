<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\CaseStudy;
use App\Models\Option;
use App\Models\Stakeholder;
use App\Models\StakeholderSection;
use App\Models\UtilitarianismSection;
use App\Models\Consequence;
use App\Models\Impact;

class ImpactController extends Controller
{
    //
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

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'impact' => 'required',
            'rank' => 'required',

            ]);

        $stakeholder = Stakeholder::where('id', $request->input('stakeholder_id'))->first();

        if($request->input('impact_id')==null){
            $impact = new Impact;
            $impact->stakeholder_id = $request->input('stakeholder_id');
            $impact->rank = $request->input('rank');
            $impact->impact = $request->input('impact');
            $impact->save();
            //set eloquent relationships

            if($impact->stakeholder()->associate($stakeholder)){
                $request->session()->flash('success', 'Impact and rank saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the impact and rank');
            }
            return  redirect()->back();

        }else{
            $impact = Impact::where('id',$request->input('impact_id'))->first();
            $impact->rank = $request->input('rank');
            $impact->impact = $request->input('impact');

            if($impact->save()){
                $request->session()->flash('success', 'Impact and rank updated');
            }else{
                $request->session()->flash('error', 'There was an error saving the impact and rank');
            }
            return  redirect()->back();
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
}
