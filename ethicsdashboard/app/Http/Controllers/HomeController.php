<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {    
        //in home.blade, form GET will be a POST to the Dashboard? Ethical Issue?
        //this will be returning course id's that match
        $id = Auth::user()->id;
        $sid=strval($id);
        $result= DB::select('select course_id from course_users where user_id='.$sid);
        $resultArray = json_decode(json_encode($result), true);
        $data = array();
        foreach($resultArray as $course){
            foreach($course as $courses){
                if(is_null($courses)==false){
                array_push($data, $courses);
                    }
                }
        }
        $courseIDs=$data;
        $courseNames=array();
        $courseCodes=array();
        $temp=array();
        foreach($data as $courseId){
            $sCourseId=strval($courseId);
            $result1= DB::select('select code,title from courses where id='.$sCourseId);
            $resultArray1 = json_decode(json_encode($result1), true);
            foreach($resultArray1 as $course1){
                foreach($course1 as $courses1){
                    if(is_null($courses1)==false){
                    array_push($temp, $courses1);
                        }
                    }
            }
        }
        $x=1;
        foreach($temp as $value){
            if($x%2){
            array_push($courseCodes, $value);
            $x++;
            }else{
                array_push($courseNames, $value);
                $x++;
            }
        }
        //create two arrays of course name and course code
        //add each to $array
        $array=array(
            'ids'=>$courseIDs,
            'codes'=>$courseCodes,
            'names'=>$courseNames
        );
        return view('home') -> with ($array);
    }
    
}