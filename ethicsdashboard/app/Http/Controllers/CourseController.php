<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;

class CourseController extends Controller
{
    public function store(Request $request){
        $c=new Course;
        $c->title=$request->input('title');
        $c-> code=$request->input('code');
        $c->number=$request->input('number');
        $c->section=$request->input('section');
        $c->year=$request->input('year');
        if($c->save()){
            $request->session()->flash('success', 'New course saved');

        }else{
            $request->session()->flash('error', 'There was an error adding the course');
        }

        $c->save();
      
        return redirect('/course');
    }
}
