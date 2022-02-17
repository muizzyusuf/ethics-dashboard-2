<?php

namespace App\Http\Controllers;

use App\Models\MoralLaw;
use Illuminate\Http\Request;
use App\Models\Option;

class MoralLawController extends Controller
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
             // dd($request->input('option_id'));

        if($request->input('moral_law1_id')==null){
            $moralLaw1 = new MoralLaw;
            $moralLaw1->option_id = $option->id;
            $moralLaw1->moral_law = $request->input('moral_law1');
            $moralLaw1->universalizability = $request->input('universalizability1');
            $moralLaw1->uni_explain = $request->input('uni_explain1');
            $moralLaw1->consistency = $request->input('consistency1');
            $moralLaw1->con_explain = $request->input('con_explain1');
            $moralLaw1->save();
            //set eloquent relationships
            $moralLaw1->option()->associate($option);

            $moralLaw2 = new MoralLaw;
            $moralLaw2->option_id = $option->id;
            $moralLaw2->moral_law = $request->input('moral_law2');
            $moralLaw2->universalizability = $request->input('universalizability2');
            $moralLaw2->uni_explain = $request->input('uni_explain2');
            $moralLaw2->consistency = $request->input('consistency2');
            $moralLaw2->con_explain = $request->input('con_explain2');
            $moralLaw2->save();
            //set eloquent relationships
            $moralLaw2->option()->associate($option);

            $moralLaw3 = new MoralLaw;
            $moralLaw3->option_id = $option->id;
            $moralLaw3->moral_law = $request->input('moral_law3');
            $moralLaw3->universalizability = $request->input('universalizability3');
            $moralLaw3->uni_explain = $request->input('uni_explain3');
            $moralLaw3->consistency = $request->input('consistency3');
            $moralLaw3->con_explain = $request->input('con_explain3');
            $moralLaw3->save();
            //set eloquent relationships
            $moralLaw3->option()->associate($option);


            if( $moralLaw3->option()->associate($option)){
                $request->session()->flash('success', 'Moral Laws saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the Moral Laws');
            }
            return  redirect()->back();

        }else{
            $moralLaw1 = MoralLaw::where('id', $request->input('moral_law1_id') )->first();
            $moralLaw1->moral_law = $request->input('moral_law1');
            $moralLaw1->universalizability = $request->input('universalizability1');
            $moralLaw1->uni_explain = $request->input('uni_explain1');
            $moralLaw1->consistency = $request->input('consistency1');
            $moralLaw1->con_explain = $request->input('con_explain1');
            $moralLaw1->save();

            $moralLaw2 = MoralLaw::where('id', $request->input('moral_law2_id') )->first();
            $moralLaw2->moral_law = $request->input('moral_law2');
            $moralLaw2->universalizability = $request->input('universalizability2');
            $moralLaw2->uni_explain = $request->input('uni_explain2');
            $moralLaw2->consistency = $request->input('consistency2');
            $moralLaw2->con_explain = $request->input('con_explain2');
            $moralLaw2->save();

            $moralLaw3 = MoralLaw::where('id', $request->input('moral_law3_id') )->first();
            $moralLaw3->moral_law = $request->input('moral_law3');
            $moralLaw3->universalizability = $request->input('universalizability3');
            $moralLaw3->uni_explain = $request->input('uni_explain3');
            $moralLaw3->consistency = $request->input('consistency3');
            $moralLaw3->con_explain = $request->input('con_explain3');
            $moralLaw3->save();

            if( $moralLaw3->save()){
                $request->session()->flash('success', 'Moral Laws saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the Moral Laws');
            }
            
            return  redirect()->back();
        }
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
