<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CaseStudy;

class CaseStudyController extends Controller
{
    public function index($course_id){
    
    //turns passed course_id to string
    //uses to query DB for all case studies' information that are in class
    $sid=strval($course_id);
    $result= DB::select('select id, name, instruction, points from case_studies where course_id='.$sid);
    $resultArray = json_decode(json_encode($result), true);

    //create individual arrays for all attributes to be passed, varaibel for course code
    $caseIDs = array();
    $caseNames = array();
    $caseInstructions = array();
    $casePoints = array();
    $courseCodes;

    //makes case study variable array traversable
    $courseCodeResult=DB::select("select code from courses where id=".$sid);
    $courses = json_decode(json_encode($courseCodeResult), true);
    foreach($courses as $course){
        foreach($course as $courseCode){
            $courseCodes=$courseCode;
        }
    }
    
    //traverse case study variable array, assign variables to corresponding arrays
    $x=0;
    foreach($resultArray as $caseData){
        foreach($caseData as $data){

                switch ($x) {
                    case 0:
                        array_push($caseIDs, $data);
                        $x++;
                        break;
                    case 1:
                        array_push($caseNames, $data);
                        $x++;
                        break;
                    case 2:
                        array_push($caseInstructions, $data);
                        $x++;
                        break;
                    case 3:
                        array_push($casePoints, $data);
                        $x=0;
                        break;
                }      
            
        }
    }

    //add array for each variable, return casestudy view with array
    $array=array(
        'ids'=>$caseIDs,
        'names'=>$caseNames,
        'instructions'=>$caseInstructions,
        'points'=>$casePoints,
        'courseCode'=>$courseCodes,
        'course_id'=>$sid
    );

    return view('casestudy') -> with ($array);
        


    }

    public function store($course_id, Request $request){

        //Creates new CaseStudy object to be pushed to DB
        //Assigns each parameter of the CaseStudy object to the inputs provided by the blade file
        $c=new CaseStudy;
        $c->name=$request->input('name');
        $c->instruction=$request->input('instruction');
        $c->points=$request->input('points');
        $c->course_id=$course_id;
         //returns error or success message if new entry is successful
        if($c->save()){
            $request->session()->flash('success', 'New case study saved');

        }else{
            $request->session()->flash('error', 'There was an error adding the case study');
        }

        $c->save();
      
        return redirect(route('casestudy', ['course_id' => $course_id]));
    }

    public function show($course_id){
        //return specified view
        $array=array(
            'course_id'=>$course_id
        );
        return view('casestudyCreate')->with($array);
    }

    public function instructions($id){
    
            //turns passed course_id to string
            //uses to query DB for all case studies' information that are in class
            $sid=strval($id);
            $result= DB::select('select name, instruction, points from case_studies where id='.$sid);
            $resultArray = json_decode(json_encode($result), true);
            $data = array();
            
            $csID=$id;
            $csName=array();
            $csInstruction=array();
            $csPoints=array();

            $x=0;
            foreach($resultArray as $caseData){
                foreach($caseData as $data){

                        switch ($x) {
                            case 0:
                                array_push($csName, $data);
                                $x++;
                                break;
                            case 1:
                                array_push($csInstruction, $data);
                                $x++;
                                break;
                            case 2:
                                array_push($csPoints, $data);
                                $x=0;
                                break;
            
                        }      
                    
                }
            }

            $array=array(
                'name'=>$csName,
                'instruction'=>$csInstruction,
                'points'=>$csPoints,
                'id'=>$csID
            );
            //returns home route with array parameter
            return view('instructions') -> with ($array);
        }
    
    
}
