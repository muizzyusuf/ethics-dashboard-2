<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Option;
use App\Models\Consequence;

class ConsequenceController extends Controller
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
            'long' => 'required',
            'short' => 'required',

            ]);

        $option = Option::where('id', $request->input('option_id'))->first();

        if($request->input('short_id')==null){
            $long = new Consequence;
            $long->option_id = $option->id;
            $long->type = 'long';
            $long->consequence = $request->input('long');
            $long->save();
            //set eloquent relationships
            $long->option()->associate($option);

            $short = new Consequence;
            $short->option_id = $option->id;
            $short->type = 'short';
            $short->consequence = $request->input('short');
            $short->save();
            //set eloquent relationships

            if($short->option()->associate($option)){
                $request->session()->flash('success', 'Long and short term consequences saved');
            }else{
                $request->session()->flash('error', 'There was an error saving the long and short term consequences');
            }
            return  redirect()->back();

        }else{
            $long = Consequence::where('id',$request->input('long_id'))->first();
            $long->consequence = $request->input('long');
            $long->save();

            $short = Consequence::where('id',$request->input('short_id'))->first();
            $short->consequence = $request->input('short');

            if($short->save()){
                $request->session()->flash('success', 'Long and short term consequences updated');
            }else{
                $request->session()->flash('error', 'There was an error updating the long and short term consequences');
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
