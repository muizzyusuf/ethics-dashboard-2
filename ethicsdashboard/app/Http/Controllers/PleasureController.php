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
use App\Models\Pleasure;

class PleasureController extends Controller
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
            'pleasure1' => 'required',
            'pleasure2' => 'required',
            'pleasure3' => 'required',
            'pleasure4' => 'required',
            'pleasure5' => 'required',
            'pleasure6' => 'required',
            'level1' => 'required',
            'level2' => 'required',
            'level3' => 'required',
            'level4' => 'required',
            'level5' => 'required',
            'level6' => 'required',
            'explanation1' => 'required',
            'explanation2' => 'required',
            'explanation3' => 'required',
            'explanation4' => 'required',
            'explanation5' => 'required',
            'explanation6' => 'required',

            ]);

        $option = Option::where('id', $request->input('option_id'))->first();
        $consequence = Consequence::where('id', $request->input('consequence_id'))->first();

        if($request->input('pleasure1_id')==null){
            $stakeholder1 = Stakeholder::where('id', $request->input('stakeholder1_id'))->first();
            $pleasure1 = new Pleasure;
            $pleasure1->option_id = $option->id;
            $pleasure1->consequence_id = $consequence->id;
            $pleasure1->stakeholder_id = $stakeholder1->id;
            $pleasure1->pleasure = $request->input('pleasure1');
            $pleasure1->level = $request->input('level1');
            $pleasure1->explanation = $request->input('explanation1');
            $pleasure1->save();
            //set eloquent relationships
            $pleasure1->option()->associate($option);
            $pleasure1->consequence()->associate($consequence);
            $pleasure1->stakeholder()->associate($stakeholder1);

            $stakeholder2 = Stakeholder::where('id', $request->input('stakeholder2_id'))->first();
            $pleasure2 = new Pleasure;
            $pleasure2->option_id = $option->id;
            $pleasure2->consequence_id = $consequence->id;
            $pleasure2->stakeholder_id = $stakeholder2->id;
            $pleasure2->pleasure = $request->input('pleasure2');
            $pleasure2->level = $request->input('level2');
            $pleasure2->explanation = $request->input('explanation2');
            $pleasure2->save();
            //set eloquent relationships
            $pleasure2->option()->associate($option);
            $pleasure2->consequence()->associate($consequence);
            $pleasure2->stakeholder()->associate($stakeholder2);

            $stakeholder3 = Stakeholder::where('id', $request->input('stakeholder3_id'))->first();
            $pleasure3 = new Pleasure;
            $pleasure3->option_id = $option->id;
            $pleasure3->consequence_id = $consequence->id;
            $pleasure3->stakeholder_id = $stakeholder3->id;
            $pleasure3->pleasure = $request->input('pleasure3');
            $pleasure3->level = $request->input('level3');
            $pleasure3->explanation = $request->input('explanation3');
            $pleasure3->save();
            //set eloquent relationships
            $pleasure3->option()->associate($option);
            $pleasure3->consequence()->associate($consequence);
            $pleasure3->stakeholder()->associate($stakeholder3);

            $stakeholder4 = Stakeholder::where('id', $request->input('stakeholder4_id'))->first();
            $pleasure4 = new Pleasure;
            $pleasure4->option_id = $option->id;
            $pleasure4->consequence_id = $consequence->id;
            $pleasure4->stakeholder_id = $stakeholder4->id;
            $pleasure4->pleasure = $request->input('pleasure4');
            $pleasure4->level = $request->input('level4');
            $pleasure4->explanation = $request->input('explanation4');
            $pleasure4->save();
            //set eloquent relationships
            $pleasure4->option()->associate($option);
            $pleasure4->consequence()->associate($consequence);
            $pleasure4->stakeholder()->associate($stakeholder4);

            $stakeholder5 = Stakeholder::where('id', $request->input('stakeholder5_id'))->first();
            $pleasure5 = new Pleasure;
            $pleasure5->option_id = $option->id;
            $pleasure5->consequence_id = $consequence->id;
            $pleasure5->stakeholder_id = $stakeholder5->id;
            $pleasure5->pleasure = $request->input('pleasure5');
            $pleasure5->level = $request->input('level5');
            $pleasure5->explanation = $request->input('explanation5');
            $pleasure5->save();
            //set eloquent relationships
            $pleasure5->option()->associate($option);
            $pleasure5->consequence()->associate($consequence);
            $pleasure5->stakeholder()->associate($stakeholder5);

            $stakeholder6 = Stakeholder::where('id', $request->input('stakeholder6_id'))->first();
            $pleasure6 = new Pleasure;
            $pleasure6->option_id = $option->id;
            $pleasure6->consequence_id = $consequence->id;
            $pleasure6->stakeholder_id = $stakeholder6->id;
            $pleasure6->pleasure = $request->input('pleasure6');
            $pleasure6->level = $request->input('level6');
            $pleasure6->explanation = $request->input('explanation6');
            $pleasure6->save();
            //set eloquent relationships
            $pleasure6->option()->associate($option);
            $pleasure6->consequence()->associate($consequence);            

            if($pleasure6->stakeholder()->associate($stakeholder6)){
                $request->session()->flash('success', 'Stakeholder pleasures for the consequence saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the stakeholder pleasures for the consequence');
            }
            return  redirect()->back();

        }else{
            
            $pleasure1 = Pleasure::where('id', $request->input('pleasure1_id') )->first();
            $pleasure1->pleasure = $request->input('pleasure1');
            $pleasure1->level = $request->input('level1');
            $pleasure1->explanation = $request->input('explanation1');
            $pleasure1->save();

            
            $pleasure2 = Pleasure::where('id', $request->input('pleasure2_id') )->first();
            $pleasure2->pleasure = $request->input('pleasure2');
            $pleasure2->level = $request->input('level2');
            $pleasure2->explanation = $request->input('explanation2');
            $pleasure2->save();
            

            
            $pleasure3 = Pleasure::where('id', $request->input('pleasure3_id') )->first();
            $pleasure3->pleasure = $request->input('pleasure3');
            $pleasure3->level = $request->input('level3');
            $pleasure3->explanation = $request->input('explanation3');
            $pleasure3->save();
            

            $pleasure4 = Pleasure::where('id', $request->input('pleasure4_id') )->first();
            $pleasure4->pleasure = $request->input('pleasure4');
            $pleasure4->level = $request->input('level4');
            $pleasure4->explanation = $request->input('explanation4');
            $pleasure4->save();
    

            $pleasure5 = Pleasure::where('id', $request->input('pleasure5_id') )->first();
            $pleasure5->pleasure = $request->input('pleasure5');
            $pleasure5->level = $request->input('level5');
            $pleasure5->explanation = $request->input('explanation5');
            $pleasure5->save();
            

            $pleasure6 = Pleasure::where('id', $request->input('pleasure6_id') )->first();
            $pleasure6->pleasure = $request->input('pleasure6');
            $pleasure6->level = $request->input('level6');
            $pleasure6->explanation = $request->input('explanation6');
            
                    

            if($pleasure6->save()){
                $request->session()->flash('success', 'Stakeholder pleasures for the consequence updateed');
            }else{
                $request->session()->flash('error', 'There was an error updating the stakeholder pleasures for the consequence');
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
