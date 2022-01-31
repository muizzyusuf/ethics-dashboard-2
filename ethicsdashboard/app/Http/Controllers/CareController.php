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

            $stakeholder2 = Stakeholder::where('id', $request->input('stakeholder2_id'))->first();
            $care2 = new Care;
            $care2->option_id = $option->id;
            $care2->stakeholder_id = $stakeholder2->id;
            $care2->attentiveness = $request->input('attentiveness2');
            $care2->competence = $request->input('competence2');
            $care2->responsiveness = $request->input('responsiveness2');
            $care2->save();
            //set eloquent relationships
            $care2->option()->associate($option);
            $care2->stakeholder()->associate($stakeholder2);

            $stakeholder3 = Stakeholder::where('id', $request->input('stakeholder3_id'))->first();
            $care3 = new Care;
            $care3->option_id = $option->id;
            $care3->stakeholder_id = $stakeholder3->id;
            $care3->attentiveness = $request->input('attentiveness3');
            $care3->competence = $request->input('competence3');
            $care3->responsiveness = $request->input('responsiveness3');
            $care3->save();
            //set eloquent relationships
            $care3->option()->associate($option);
            $care3->stakeholder()->associate($stakeholder3);

            $stakeholder4 = Stakeholder::where('id', $request->input('stakeholder4_id'))->first();
            $care4 = new Care;
            $care4->option_id = $option->id;
            $care4->stakeholder_id = $stakeholder4->id;
            $care4->attentiveness = $request->input('attentiveness4');
            $care4->competence = $request->input('competence4');
            $care4->responsiveness = $request->input('responsiveness4');
            $care4->save();
            //set eloquent relationships
            $care4->option()->associate($option);
            $care4->stakeholder()->associate($stakeholder4);

            $stakeholder5 = Stakeholder::where('id', $request->input('stakeholder5_id'))->first();
            $care5 = new Care;
            $care5->option_id = $option->id;
            $care5->stakeholder_id = $stakeholder5->id;
            $care5->attentiveness = $request->input('attentiveness5');
            $care5->competence = $request->input('competence5');
            $care5->responsiveness = $request->input('responsiveness5');
            $care5->save();
            //set eloquent relationships
            $care5->option()->associate($option);
            $care5->stakeholder()->associate($stakeholder5);

            $stakeholder6 = Stakeholder::where('id', $request->input('stakeholder6_id'))->first();
            $care6 = new Care;
            $care6->option_id = $option->id;
            $care6->stakeholder_id = $stakeholder6->id;
            $care6->attentiveness = $request->input('attentiveness6');
            $care6->competence = $request->input('competence6');
            $care6->responsiveness = $request->input('responsiveness6');
            $care6->save();
            //set eloquent relationships
            $care6->option()->associate($option);

            if($care6->stakeholder()->associate($stakeholder6)){
                $request->session()->flash('success', 'Stakeholder care values saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the care values');
            }
            return  redirect()->back();

        }else{
            
            $care1 = Care::where('id', $request->input('care1_id') )->first();
            $care1->attentiveness = $request->input('attentiveness1');
            $care1->competence = $request->input('competence1');
            $care1->responsiveness = $request->input('responsiveness1');
            $care1->save();

            $care2 = Care::where('id', $request->input('care2_id') )->first();
            $care2->attentiveness = $request->input('attentiveness2');
            $care2->competence = $request->input('competence2');
            $care2->responsiveness = $request->input('responsiveness2');
            $care2->save();

            $care3 = Care::where('id', $request->input('care3_id') )->first();
            $care3->attentiveness = $request->input('attentiveness3');
            $care3->competence = $request->input('competence3');
            $care3->responsiveness = $request->input('responsiveness3');
            $care3->save();

            $care4 = Care::where('id', $request->input('care4_id') )->first();
            $care4->attentiveness = $request->input('attentiveness4');
            $care4->competence = $request->input('competence4');
            $care4->responsiveness = $request->input('responsiveness4');
            $care4->save();

            $care5 = Care::where('id', $request->input('care5_id') )->first();
            $care5->attentiveness = $request->input('attentiveness5');
            $care5->competence = $request->input('competence5');
            $care5->responsiveness = $request->input('responsiveness5');
            $care5->save();

            $care6 = Care::where('id', $request->input('care6_id') )->first();
            $care6->attentiveness = $request->input('attentiveness6');
            $care6->competence = $request->input('competence6');
            $care6->responsiveness = $request->input('responsiveness6');

            if($care6->save()){
                $request->session()->flash('success', 'Stakeholder care values updated');
            }else{
                $request->session()->flash('error', 'There was an error updating the stakeholder care values');
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
