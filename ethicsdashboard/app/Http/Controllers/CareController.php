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
        $stakeholder = Stakeholder::where('id', $request->input('stakeholder_id'))->first();
      
            $care = new Care;
            $care->option_id = $option->id;
            $care->stakeholder_id = $stakeholder->id;
            $care->attentiveness = $request->input('attentiveness');
            $care->competence = $request->input('competence');
            $care->responsiveness = $request->input('responsiveness');
            $care->save();
     


            /*Need confrimation message*/

       
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
