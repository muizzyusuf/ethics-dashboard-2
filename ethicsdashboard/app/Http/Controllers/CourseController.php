<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;

class CourseController extends Controller
{
    public function store(Request $request){
        Course::create([
            //do i need to request for id each time? or can we have it autocreate class ID's
            'id' => $request->id,
            'title' => $request->title,
            'code' => $request->code,
            'number' => $request->number,
            'section' => $request->section,
            'year' => $request->year
    
        ]);
        return redirect('/course');
    }
}
