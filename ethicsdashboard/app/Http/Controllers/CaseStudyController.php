<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CaseStudyController extends Controller
{
    public function index($course_id){
    $id = Auth::user()->id;
    $sid=strval($course_id);
    $result= DB::select('select name from case_studies where course_id='.$sid);
    $resultArray = json_decode(json_encode($result), true);
    $data = array();
    foreach($resultArray as $cases){
        foreach($cases as $case){
            if(is_null($case)==false){
            array_push($data, $case);
                }
            }
        }

    return $data;
        


    }


class CaseStudyController extends Controller
{
    //

}
