<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Stakeholder;
use App\Models\StakeholderSection;
use App\Models\EthicalIssue;


class StakeholderController extends Controller
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

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'stakeholder1' => 'required',
            'stakeholder2' => 'required',
            'stakeholder3' => 'required',
            'stakeholder4' => 'required',
            'stakeholder5' => 'required',
            'stakeholder6' => 'required',
            'interest1' => 'required',
            'interest2' => 'required',
            'interest3' => 'required',
            'interest4' => 'required',
            'interest5' => 'required',
            'interest6' => 'required',
            
            ]);

        $ethicalissue = EthicalIssue::where('id', $request->input('id'))->first();
        $stakeholder_section = StakeholderSection::where('id', $request->input('stakeholder_section_id'))->first();

        if($request->input('stakeholder1_id')==null){

            $stakeholder1 = new Stakeholder;
            $stakeholder1->stakeholder = $request->input('stakeholder1');
            $stakeholder1->interests = $request->input('interest1');
            $stakeholder1->stakeholder_section_id = $request->input('stakeholder_section_id');
            $stakeholder1->save();
            //set eloquent relationships
            $stakeholder1->stakeholderSection()->associate($stakeholder_section);

            $stakeholder2 = new Stakeholder;
            $stakeholder2->stakeholder = $request->input('stakeholder2');
            $stakeholder2->interests = $request->input('interest2');
            $stakeholder2->stakeholder_section_id = $request->input('stakeholder_section_id');
            $stakeholder2->save();
            //set eloquent relationships
            $stakeholder2->stakeholderSection()->associate($stakeholder_section);

            $stakeholder3 = new Stakeholder;
            $stakeholder3->stakeholder = $request->input('stakeholder3');
            $stakeholder3->interests = $request->input('interest3');
            $stakeholder3->stakeholder_section_id = $request->input('stakeholder_section_id');
            $stakeholder3->save();
            //set eloquent relationships
            $stakeholder3->stakeholderSection()->associate($stakeholder_section);

            $stakeholder4 = new Stakeholder;
            $stakeholder4->stakeholder = $request->input('stakeholder4');
            $stakeholder4->interests = $request->input('interest4');
            $stakeholder4->stakeholder_section_id = $request->input('stakeholder_section_id');
            $stakeholder4->save();
            //set eloquent relationships
            $stakeholder4->stakeholderSection()->associate($stakeholder_section);

            $stakeholder5 = new Stakeholder;
            $stakeholder5->stakeholder = $request->input('stakeholder5');
            $stakeholder5->interests = $request->input('interest5');
            $stakeholder5->stakeholder_section_id = $request->input('stakeholder_section_id');
            $stakeholder5->save();
            //set eloquent relationships
            $stakeholder5->stakeholderSection()->associate($stakeholder_section);

            $stakeholder6 = new Stakeholder;
            $stakeholder6->stakeholder = $request->input('stakeholder6');
            $stakeholder6->interests = $request->input('interest6');
            $stakeholder6->stakeholder_section_id = $request->input('stakeholder_section_id');
            $stakeholder6->save();
            //set eloquent relationships

            if($stakeholder6->stakeholderSection()->associate($stakeholder_section)){
                $request->session()->flash('success', 'Stakeholders and interests saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the stakeholders and interests');
            }
            return  redirect(route('stakeholdersection.show', $request->input('stakeholder_section_id')));

        }else{
            $stakeholder1 = Stakeholder::where('id', $request->input('stakeholder1_id'))->first();
            $stakeholder1->stakeholder = $request->input('stakeholder1');
            $stakeholder1->interests = $request->input('interest1');
            $stakeholder1->save();

            $stakeholder2 = Stakeholder::where('id', $request->input('stakeholder2_id'))->first();
            $stakeholder2->stakeholder = $request->input('stakeholder2');
            $stakeholder2->interests = $request->input('interest2');
            $stakeholder2->save();

            $stakeholder3 = Stakeholder::where('id', $request->input('stakeholder3_id'))->first();
            $stakeholder3->stakeholder = $request->input('stakeholder3');
            $stakeholder3->interests = $request->input('interest3');
            $stakeholder3->save();

            $stakeholder4 = Stakeholder::where('id', $request->input('stakeholder4_id'))->first();
            $stakeholder4->stakeholder = $request->input('stakeholder4');
            $stakeholder4->interests = $request->input('interest4');
            $stakeholder4->save();

            $stakeholder5 = Stakeholder::where('id', $request->input('stakeholder5_id'))->first();
            $stakeholder5->stakeholder = $request->input('stakeholder5');
            $stakeholder5->interests = $request->input('interest5');
            $stakeholder5->save();

            $stakeholder6 = Stakeholder::where('id', $request->input('stakeholder1_id'))->first();
            $stakeholder6->stakeholder = $request->input('stakeholder6');
            $stakeholder6->interests = $request->input('interest6');

            if($stakeholder6->save()){
                $request->session()->flash('success', 'Stakeholders and interests updated');
            }else{
                $request->session()->flash('error', 'There was an error updating the stakeholders and interests');
            }
            return  redirect(route('stakeholdersection.show', $request->input('stakeholder_section_id')));
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
