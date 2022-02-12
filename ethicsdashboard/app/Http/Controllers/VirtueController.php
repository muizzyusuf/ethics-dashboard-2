<?php

namespace App\Http\Controllers;

use App\Models\Virtue;
use Illuminate\Http\Request;

use App\Models\VirtueSection;
use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\CaseStudy;
use App\Models\Option;
use App\Models\Stakeholder;
use App\Models\StakeholderSection;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VirtueController extends Controller
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
        if($request->input('stakeholder1_id') !== null){

            if($request->input('virtue1_id') !== null){

                $virtue1 = Virtue::where('id', $request->input('virtue1_id'));
                $virtue1->excess = $request->input('excess1');
                $virtue1->mean = $request->input('mean1');
                $virtue1->deficiency = $request->input('deficiency1');
                $virtue1->value = $request->input('value1');
                if($request->input('value1')>= -9 && $request->input('value1') <= -5){
                    $virtue1->virtue = $request->input('excess1');
                }else if($request->input('value1')>= -4 && $request->input('value1') <= 4){
                    $virtue1->virtue = $request->input('mean1');
                }else{
                    $virtue1->virtue = $request->input('deficiency1');
                }
                $virtue1->save();

                $virtue2 = Virtue::where('id', $request->input('virtue2_id'));
                $virtue2->excess = $request->input('excess2');
                $virtue2->mean = $request->input('mean2');
                $virtue2->deficiency = $request->input('deficiency2');
                $virtue2->value = $request->input('value2');
                if($request->input('value2')>= -9 && $request->input('value2') <= -5){
                    $virtue2->virtue = $request->input('excess2');
                }else if($request->input('value2')>= -4 && $request->input('value2') <= 4){
                    $virtue2->virtue = $request->input('mean2');
                }else{
                    $virtue2->virtue = $request->input('deficiency2');
                }
                $virtue2->save();

                $virtue3 = Virtue::where('id', $request->input('virtue3_id'));
                $virtue3->excess = $request->input('excess3');
                $virtue3->mean = $request->input('mean3');
                $virtue3->deficiency = $request->input('deficiency3');
                $virtue3->value = $request->input('value3');
                if($request->input('value3')>= -9 && $request->input('value3') <= -5){
                    $virtue3->virtue = $request->input('excess3');
                }else if($request->input('value3')>= -4 && $request->input('value3') <= 4){
                    $virtue3->virtue = $request->input('mean3');
                }else{
                    $virtue3->virtue = $request->input('deficiency3');
                }
                $virtue3->save();

                $virtue4 = Virtue::where('id', $request->input('virtue4_id'));
                $virtue4->excess = $request->input('excess4');
                $virtue4->mean = $request->input('mean4');
                $virtue4->deficiency = $request->input('deficiency4');
                $virtue4->value = $request->input('value4');
                if($request->input('value4')>= -9 && $request->input('value4') <= -5){
                    $virtue4->virtue = $request->input('excess4');
                }else if($request->input('value4')>= -4 && $request->input('value4') <= 4){
                    $virtue4->virtue = $request->input('mean4');
                }else{
                    $virtue4->virtue = $request->input('deficiency4');
                }
                $virtue4->save();

                $virtue5 = Virtue::where('id', $request->input('virtue5_id'));
                $virtue5->excess = $request->input('excess5');
                $virtue5->mean = $request->input('mean5');
                $virtue5->deficiency = $request->input('deficiency5');
                $virtue5->value = $request->input('value5');
                if($request->input('value5')>= -9 && $request->input('value5') <= -5){
                    $virtue5->virtue = $request->input('excess5');
                }else if($request->input('value5')>= -4 && $request->input('value5') <= 4){
                    $virtue5->virtue = $request->input('mean5');
                }else{
                    $virtue5->virtue = $request->input('deficiency5');
                }
                $virtue5->save();

                $virtue6 = Virtue::where('id', $request->input('virtue6_id'));
                $virtue6->excess = $request->input('excess6');
                $virtue6->mean = $request->input('mean6');
                $virtue6->deficiency = $request->input('deficiency6');
                $virtue6->value = $request->input('value6');
                if($request->input('value6')>= -9 && $request->input('value6') <= -5){
                    $virtue6->virtue = $request->input('excess6');
                }else if($request->input('value6')>= -4 && $request->input('value6') <= 4){
                    $virtue6->virtue = $request->input('mean6');
                }else{
                    $virtue6->virtue = $request->input('deficiency6');
                }
    
                if($virtue6->save()){
                    $request->session()->flash('success', 'Stakeholder virtues and vices updated');
                }else{
                    $request->session()->flash('error', 'There was an error updating the stakeholder virtues and vices');
                }
                return  redirect(route('virtuesection.show', $request->input('virtue_section_id')));

                
    
            }else{

                $virtue1 = new Virtue;
                $virtue1->excess = $request->input('excess1');
                $virtue1->mean = $request->input('mean1');
                $virtue1->deficiency = $request->input('deficiency1');
                $virtue1->value = $request->input('value1');
                if($request->input('value1')>= -9 && $request->input('value1') <= -5){
                    $virtue1->virtue = $request->input('excess1');
                }else if($request->input('value1')>= -4 && $request->input('value1') <= 4){
                    $virtue1->virtue = $request->input('mean1');
                }else{
                    $virtue1->virtue = $request->input('deficiency1');
                }
                $virtue1->save();
                $stakeholder1 = Stakeholder::where('id', $request->input('stakeholder1_id'))->first();
                $stakeholder1->virtue_id = $virtue1->id;
                $stakeholder1->save();
                //set eloquent relationships
                $stakeholder1->virtue()->associate($virtue1);

                $virtue2 = new Virtue;
                $virtue2->excess = $request->input('excess2');
                $virtue2->mean = $request->input('mean2');
                $virtue2->deficiency = $request->input('deficiency2');
                $virtue2->value = $request->input('value2');
                if($request->input('value2')>= -9 && $request->input('value2') <= -5){
                    $virtue2->virtue = $request->input('excess2');
                }else if($request->input('value2')>= -4 && $request->input('value2') <= 4){
                    $virtue2->virtue = $request->input('mean2');
                }else{
                    $virtue2->virtue = $request->input('deficiency2');
                }
                $virtue2->save();
                $stakeholder2 = Stakeholder::where('id', $request->input('stakeholder2_id'))->first();
                $stakeholder2->virtue_id = $virtue2->id;
                $stakeholder2->save();
                //set eloquent relationships
                $stakeholder2->virtue()->associate($virtue2);

                $virtue3 = new Virtue;
                $virtue3->excess = $request->input('excess3');
                $virtue3->mean = $request->input('mean3');
                $virtue3->deficiency = $request->input('deficiency3');
                $virtue3->value = $request->input('value3');
                if($request->input('value3')>= -9 && $request->input('value3') <= -5){
                    $virtue3->virtue = $request->input('excess3');
                }else if($request->input('value3')>= -4 && $request->input('value3') <= 4){
                    $virtue3->virtue = $request->input('mean3');
                }else{
                    $virtue3->virtue = $request->input('deficiency3');
                }
                $virtue3->save();
                $stakeholder3 = Stakeholder::where('id', $request->input('stakeholder3_id'))->first();
                $stakeholder3->virtue_id = $virtue3->id;
                $stakeholder3->save();
                //set eloquent relationships
                $stakeholder3->virtue()->associate($virtue3);

                $virtue4 = new Virtue;
                $virtue4->excess = $request->input('excess4');
                $virtue4->mean = $request->input('mean4');
                $virtue4->deficiency = $request->input('deficiency4');
                $virtue4->value = $request->input('value4');
                if($request->input('value4')>= -9 && $request->input('value4') <= -5){
                    $virtue4->virtue = $request->input('excess4');
                }else if($request->input('value4')>= -4 && $request->input('value4') <= 4){
                    $virtue4->virtue = $request->input('mean4');
                }else{
                    $virtue4->virtue = $request->input('deficiency4');
                }
                $virtue4->save();
                $stakeholder4 = Stakeholder::where('id', $request->input('stakeholder4_id'))->first();
                $stakeholder4->virtue_id = $virtue4->id;
                $stakeholder4->save();
                //set eloquent relationships
                $stakeholder4->virtue()->associate($virtue4);

                $virtue5 = new Virtue;
                $virtue5->excess = $request->input('excess5');
                $virtue5->mean = $request->input('mean5');
                $virtue5->deficiency = $request->input('deficiency5');
                $virtue5->value = $request->input('value5');
                if($request->input('value5')>= -9 && $request->input('value5') <= -5){
                    $virtue5->virtue = $request->input('excess5');
                }else if($request->input('value5')>= -4 && $request->input('value5') <= 4){
                    $virtue5->virtue = $request->input('mean5');
                }else{
                    $virtue5->virtue = $request->input('deficiency5');
                }
                $virtue5->save();
                $stakeholder5 = Stakeholder::where('id', $request->input('stakeholder5_id'))->first();
                $stakeholder5->virtue_id = $virtue5->id;
                $stakeholder5->save();
                //set eloquent relationships
                $stakeholder5->virtue()->associate($virtue5);

                $virtue6 = new Virtue;
                $virtue6->excess = $request->input('excess6');
                $virtue6->mean = $request->input('mean6');
                $virtue6->deficiency = $request->input('deficiency6');
                $virtue6->value = $request->input('value6');
                if($request->input('value6')>= -9 && $request->input('value6') <= -5){
                    $virtue6->virtue = $request->input('excess6');
                }else if($request->input('value6')>= -4 && $request->input('value6') <= 4){
                    $virtue6->virtue = $request->input('mean6');
                }else{
                    $virtue6->virtue = $request->input('deficiency6');
                }
                $virtue6->save();
                $stakeholder6 = Stakeholder::where('id', $request->input('stakeholder6_id'))->first();
                $stakeholder6->virtue_id = $virtue6->id;
                $stakeholder6->save();
                //set eloquent relationships
    
                if($stakeholder6->virtue()->associate($virtue1)){
                    $request->session()->flash('success', 'Stakeholder virtues and vices saved');
                }else{
                    $request->session()->flash('error', 'There was an error saving the stakeholder virtues and vices');
                }
                return  redirect(route('virtuesection.show', $request->input('virtue_section_id')));
            }   

        


        }else{
        
        
        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Virtue  $virtue
     * @return \Illuminate\Http\Response
     */
    public function show(Virtue $virtue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Virtue  $virtue
     * @return \Illuminate\Http\Response
     */
    public function edit(Virtue $virtue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Virtue  $virtue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Virtue $virtue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Virtue  $virtue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Virtue $virtue)
    {
        //
    }
}
