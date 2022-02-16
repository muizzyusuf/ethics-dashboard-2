<?php

namespace App\Http\Controllers;

use App\Models\Motivation;
use App\Models\Option;
use Illuminate\Http\Request;

class MotivationController extends Controller
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
        if($request->input('motivation1_id')==null){
            $motivation1 = new Motivation;
            $motivation1->option_id = $option->id;
            $motivation1->motivation = $request->input('motivation1');
            $motivation1->save();
            //set eloquent relationships
            $motivation1->option()->associate($option);

            $motivation2 = new Motivation;
            $motivation2->option_id = $option->id;
            $motivation2->motivation = $request->input('motivation2');
            $motivation2->save();
            //set eloquent relationships
            $motivation2->option()->associate($option);
            
            $motivation3 = new Motivation;
            $motivation3->option_id = $option->id;
            $motivation3->motivation = $request->input('motivation3');
            $motivation3->save();
            //set eloquent relationships
            $motivation3->option()->associate($option);
            
            $motivation4 = new Motivation;
            $motivation4->option_id = $option->id;
            $motivation4->motivation = $request->input('motivation4');
            $motivation4->save();
            //set eloquent relationships
            $motivation4->option()->associate($option);

            $motivation5 = new Motivation;
            $motivation5->option_id = $option->id;
            $motivation5->motivation = $request->input('motivation5');
            $motivation5->save();
            //set eloquent relationships
            $motivation5->option()->associate($option);

            $motivation6 = new Motivation;
            $motivation6->option_id = $option->id;
            $motivation6->motivation = $request->input('motivation6');
            $motivation6->save();
            //set eloquent relationships
            $motivation6->option()->associate($option);

            $motivation7 = new Motivation;
            $motivation7->option_id = $option->id;
            $motivation7->motivation = $request->input('motivation7');
            $motivation7->save();
            //set eloquent relationships
            $motivation7->option()->associate($option);
            
            return  redirect()->back();
            
        }else{
            $motivation1 = Motivation::where('id', $request->input('motivation1_id') )->first();
            $motivation1->motivation = $request->input('motivation1');
            $motivation1->save();

            $motivation2 = Motivation::where('id', $request->input('motivation2_id') )->first();
            $motivation2->motivation = $request->input('motivation2');
            $motivation2->save();

            $motivation3 = Motivation::where('id', $request->input('motivation3_id') )->first();
            $motivation3->motivation = $request->input('motivation3');
            $motivation3->save();

            $motivation4 = Motivation::where('id', $request->input('motivation4_id') )->first();
            $motivation4->motivation = $request->input('motivation4');
            $motivation4->save();

            $motivation5 = Motivation::where('id', $request->input('motivation5_id') )->first();
            $motivation5->motivation = $request->input('motivation5');
            $motivation5->save();

            $motivation6 = Motivation::where('id', $request->input('motivation6_id') )->first();
            $motivation6->motivation = $request->input('motivation6');
            $motivation6->save();

            $motivation7 = Motivation::where('id', $request->input('motivation7_id') )->first();
            $motivation7->motivation = $request->input('motivation7');
            $motivation7->save();
        }
        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motivation  $motivation
     * @return \Illuminate\Http\Response
     */
    public function show(Motivation $motivation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motivation  $motivation
     * @return \Illuminate\Http\Response
     */
    public function edit(Motivation $motivation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motivation  $motivation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motivation $motivation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motivation  $motivation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motivation $motivation)
    {
        //
    }
}
