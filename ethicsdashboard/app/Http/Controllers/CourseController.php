<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use App\Models\CaseStudy;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $this->validate($request, [
            'code' => 'required',
            'number' => 'required',
            'title'=> 'required',
            'section' => 'required',
            'year' => 'required',
            ]);
        
        $c = new Course;
        $c->title = $request->input('title');
        $c->code = $request->input('code');
        $c->number = $request->input('number');
        $c->section = $request->input('section');
        $c->year = $request->input('year');
        $c->save();

        //get user and input user_id into course user table
        $user = User::where('id', $request->input('user_id'))->first();

        //eloquent relationship saves to course_users table
        if( $c->users()->save($user)){
            $request->session()->flash('success', 'New course saved');
            
        }else{
            $request->session()->flash('error', 'There was an error adding the course');
           
        }

        return redirect('/home');

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
        $course = Course::where('id', $id)->first();
        $casestudies = CaseStudy::where('course_id', $id)->get();

        if(Auth::user()->role()->first()->id == 3){
            return view('student.course')->with('course', $course)->with('casestudies',$casestudies);
        }else{
            return view('course')->with('course', $course)->with('casestudies',$casestudies);
        }

        return view('course')->with('course', $course)->with('casestudies',$casestudies);
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
        $this->validate($request, [
            'code' => 'required',
            'number' => 'required',
            'title'=> 'required',
            'section' => 'required',
            'year' => 'required',
            ]);
        
        //get course by id for updating values
        $c = Course::where('id', $id)->first();
        $c->title = $request->input('title');
        $c->code = $request->input('code');
        $c->number = $request->input('number');
        $c->section = $request->input('section');
        $c->year = $request->input('year');

        if($c->save()){
            $request->session()->flash('success', 'Course updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the course');
        }

        return redirect('/home');
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
        //get course by id for deleting 
        $c = Course::where('id', $id)->first();
        
        if($c->delete()){
            $request->session()->flash('success','Course has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the course');
        }

        return redirect('/home');
    }

    public function people($id)
    {
        //
        $course = Course::where('id', $id)->first();
        $people = Course::join('course_users','courses.id',"=","course_users.course_id")
                    ->join('users','course_users.user_id',"=","users.id")
                    ->join('roles', 'users.role_id','=','roles.id')
                    ->select('users.name', 'users.email', 'users.id', 'roles.role', 'users.role_id')
                    ->where('courses.id','=',$id)->get();

        $students = User::join('roles', 'users.role_id','=','roles.id')
                    ->select('users.name', 'users.email', 'users.id', 'roles.role', 'users.role_id')
                    ->where('roles.id','=','3')->get();

        $teachingAssistants = User::join('roles', 'users.role_id','=','roles.id')
                    ->select('users.name', 'users.email', 'users.id', 'roles.role', 'users.role_id')
                    ->where('roles.id','=','2')->get();

        if(Auth::user()->role()->first()->id == 3){
            return view('student.people')->with('course', $course)
                            ->with('people',$people)
                            ->with('students',$students)
                            ->with('teachingAssistants',$teachingAssistants);
        }else{
            return view('people')->with('course', $course)
                            ->with('people',$people)
                            ->with('students',$students)
                            ->with('teachingAssistants',$teachingAssistants);
        }

        
    }

    public function grade($id)
    {
        //
        $course = Course::where('id', $id)->first();
        $students = Course::join('course_users','courses.id',"=","course_users.course_id")
                    ->join('users','course_users.user_id',"=","users.id")
                    ->join('roles', 'users.role_id','=','roles.id')
                    ->select('users.name', 'users.email', 'users.id', 'roles.role', 'users.role_id')
                    ->where('users.role_id', '=', 3)
                    ->where('courses.id','=',$id)->get();

        $student = User::where('id',Auth::user()->id)->first();

        $dashboards = Dashboard::join("case_studies", "dashboards.case_study_id","=","case_studies.id")
                    ->select('dashboards.user_id','dashboards.id','dashboards.grade','case_studies.name', 'case_studies.points')
                    ->where('case_studies.course_id',$id)->get();
                
        $dboards = Dashboard::join("case_studies", "dashboards.case_study_id","=","case_studies.id")
                    ->select('dashboards.user_id','dashboards.id','dashboards.grade','case_studies.name', 'case_studies.points', 'case_studies.id AS case_study_id')
                    ->where('dashboards.user_id',Auth::user()->id)
                    ->where('case_studies.course_id',$id)->get();

        $casestudies = CaseStudy::where('course_id', $id)->get();
    

        if(Auth::user()->role()->first()->id == 3){
            return view('student.grade')->with('course', $course)
                            ->with('dboards', $dboards)
                            ->with('casestudies', $casestudies)
                            ->with('student', $student);
        }else{
            return view('grade')->with('course', $course)
                            ->with('dashboards', $dashboards)
                            ->with('casestudies', $casestudies)
                            ->with('students', $students);
        }

        
                            
    }
}
