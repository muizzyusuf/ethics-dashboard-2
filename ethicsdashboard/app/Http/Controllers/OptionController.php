<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function store(Request $request){

          //for validating: 
            //1. create an array from the request 
            //2.shift the array -  array_shift
            //3. selecting the subarray based on the index
            //4.Create stakeholder section, associate this section with a dashboard , then save this section 
            //loop through each one the request, make a stakeholder for each one then retreive stakehodler id from the section made before
            // stakeholder controller and blade for references and routes (web.php)
        $this->validate($request, [
            'ethicalIssue' => 'required',
            'option1' => 'required',
            'option2'=> 'required',
            'option3' => 'required',
            'option4' => 'required',
            'stakeholder1' => 'required',
            'stakeholder2'=> 'required',
            'stakeholder3' => 'required',
            'stakeholder4' => 'required',

            ]);
        $c=new Option;
        $c->ethicalIssue=$request->input('ethicalIssue');
        $c->option1=$request->input('option1');
        $c->option2=$request->input('option2');
        $c->option3=$request->input('option3');
        $c->option4=$request->input('option4');
        $c->option1=$request->input('stakeholder1');
        $c->option2=$request->input('stakeholder2');
        $c->option3=$request->input('stakeholder3');
        $c->option4=$request->input('stakeholder4');
        $c->save();


 //returns error or success message if new entry is successful
        if($c->save()){
            $request->session()->flash('success', 'Submission was sucessful :) !');

        }else{
            $request->session()->flash('error', 'Sorry, Something went wrong :(');
        }

        $c->save();
      
        return redirect('welcome');


      


      }
    
    }
