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
        
        $this->validate($request, [
            'motivations' => 'required_without_all:other|array|min:1',

            ]);
        //
        $option = Option::where('id', $request->input('option_id'))->first();

        $oldMotivation = Motivation::where('option_id', $request->input('option_id'))->delete();

        $motivations = $request->input('motivations');

        if($request->input('motivations') != null){
            foreach($motivations as $m){
                $motivation = new Motivation;
                $motivation->motivation = $m;
                $motivation->option_id = $option->id;
                $motivation->other = 'No';
                $motivation->save();
    
                 //set eloquent relationships
                if( $motivation->option()->associate($option)){
                    $request->session()->flash('success', 'Motivations saved');
                }else{
                    $request->session()->flash('error', 'There was an error saving the motivations');
                }
            }

            if(in_array("It's the right thing to do", $motivations)){
                $option->imperative = 'categorical';
                $option->save();
            }else{
                $option->imperative = 'hypothetical';
                $option->save();
            }
        }

        if($request->input('other') != null){
            $motivation = new Motivation;
            $motivation->motivation = $request->input('other');
            $motivation->option_id = $option->id;
            $motivation->other = 'Yes';
            $motivation->save();

            if($request->input('motivations') == null ){
                $option->imperative = 'hypothetical';
                $option->save();
            }

             //set eloquent relationships
            if( $motivation->option()->associate($option)){
                $request->session()->flash('success', 'Motivations saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the motivations');
            }
        }
        
        return  redirect()->back();

        // if($request->input('motivation11_id')==null){
        //     $motivation11 = new Motivation;
        //     $motivation11->option_id = $option->id;
        //     $motivation11->motivation = $request->input('motivation11');
        //     $motivation11->save();
        //     //set eloquent relationships
        //     $motivation11->option()->associate($option);

        //     $motivation21 = new Motivation;
        //     $motivation21->option_id = $option->id;
        //     $motivation21->motivation = $request->input('motivation21');
        //     $motivation21->save();
        //     //set eloquent relationships
        //     $motivation21->option()->associate($option);
            
        //     $motivation31 = new Motivation;
        //     $motivation31->option_id = $option->id;
        //     $motivation31->motivation = $request->input('motivation31');
        //     $motivation31->save();
        //     //set eloquent relationships
        //     $motivation31->option()->associate($option);
            
        //     $motivation41 = new Motivation;
        //     $motivation41->option_id = $option->id;
        //     $motivation41->motivation = $request->input('motivation41');
        //     $motivation41->save();
        //     //set eloquent relationships
        //     $motivation41->option()->associate($option);

        //     $motivation51 = new Motivation;
        //     $motivation51->option_id = $option->id;
        //     $motivation51->motivation = $request->input('motivation51');
        //     $motivation51->save();
        //     //set eloquent relationships
        //     $motivation51->option()->associate($option);

        //     $motivation61 = new Motivation;
        //     $motivation61->option_id = $option->id;
        //     $motivation61->motivation = $request->input('motivation61');
        //     $motivation61->save();
        //     //set eloquent relationships
        //     $motivation61->option()->associate($option);

        //     $motivation71 = new Motivation;
        //     $motivation71->option_id = $option->id;
        //     $motivation71->motivation = $request->input('motivation71');
        //     $motivation71->save();
        //     //set eloquent relationships
        //     $motivation71->option()->associate($option);
            
        //     if( $motivation71->option()->associate($option)){
        //         $request->session()->flash('success', 'Motivations saved');
        //     }else{
        //         $request->session()->flash('error', 'There was an error saving the Motivations');
        //     }
        //     return  redirect()->back();
            
        // }else{
        //     $motivation11= Motivation::where('id', $request->input('motivation1_id') )->first();
        //     $motivation11->motivation = $request->input('motivation1');
        //     $motivation11->save();

        //     $motivation21 = Motivation::where('id', $request->input('motivation21_id') )->first();
        //     $motivation21->motivation = $request->input('motivation21');
        //     $motivation21->save();

        //     $motivation31 = Motivation::where('id', $request->input('motivation31_id') )->first();
        //     $motivation31->motivation = $request->input('motivation31');
        //     $motivation31->save();

        //     $motivation41 = Motivation::where('id', $request->input('motivation41_id') )->first();
        //     $motivation41->motivation = $request->input('motivation41');
        //     $motivation41->save();

        //     $motivation51 = Motivation::where('id', $request->input('motivation51_id') )->first();
        //     $motivation51->motivation = $request->input('motivation51');
        //     $motivation51->save();

        //     $motivation61 = Motivation::where('id', $request->input('motivation61_id') )->first();
        //     $motivation61->motivation = $request->input('motivation61');
        //     $motivation61->save();

        //     $motivation71 = Motivation::where('id', $request->input('motivation71_id') )->first();
        //     $motivation71->motivation = $request->input('motivation71');
        //     $motivation71->save();

        //     if( $motivation71->save()){
        //         $request->session()->flash('success', 'Motivations saved');
        //     }else{
        //         $request->session()->flash('error', 'There was an error saving the Motivations');
        //     }
        // }
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
