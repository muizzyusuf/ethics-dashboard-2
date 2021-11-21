<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Course;
use App\Models\User;



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
        
        $id = Auth::user()->id;

        $courses = User::join('course_users', 'users.id', '=', 'course_users.user_id')
        ->join('courses', 'course_users.course_id', '=', 'courses.id')
        ->select('courses.id','courses.code', 'courses.section','courses.number','courses.title','courses.section', 'courses.year')
        ->where('users.id','=',$id)
        ->get();

        if(Auth::user()->role()->first()->id == 3){
            return view('student.home')->with('id', $id)->with('courses', $courses);
        }else{
            return view('home')->with('id', $id)->with('courses', $courses);
        }

        
    }
    
}

