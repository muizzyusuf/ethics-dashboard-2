<?php

namespace App\Http\Controllers;

use App\Models\Care;
use App\Models\Option;
use App\Models\Stakeholder;
use Illuminate\Http\Request;

class CareController extends Controller
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
        

        $option = Option::where('id', $request->input('option_id'))->first();

        if($request->input('care1_id')==null){
            $stakeholder1 = Stakeholder::where('id', $request->input('stakeholder1_id'))->first();
            $care1 = new Care;
            $care1->option_id = $option->id;
            $care1->stakeholder_id = $stakeholder1->id;
            $care1->attentiveness = $request->input('attentiveness1');
            $care1->competence = $request->input('competence1');
            $care1->responsiveness = $request->input('responsiveness1');
            $care1->save();
            //set eloquent relationships
            $care1->option()->associate($option);
            $care1->stakeholder()->associate($stakeholder1);


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
     * @param  \App\Models\Care  $care
     * @return \Illuminate\Http\Response
     */
    public function show(Care $care)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Care  $care
     * @return \Illuminate\Http\Response
     */
    public function edit(Care $care)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Care  $care
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Care $care)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Care  $care
     * @return \Illuminate\Http\Response
     */
    public function destroy(Care $care)
    {
        //
    }
}
