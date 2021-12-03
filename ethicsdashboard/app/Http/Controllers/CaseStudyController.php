<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CaseStudy;
use App\Models\Course;
use App\Models\Dashboard;

class CaseStudyController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $this->validate($request, [
            'name' => 'required',
            'instruction' => 'required',
            'issue_points'=> 'required',
            'util_points'=> 'required',
            'stakeholder_points'=> 'required',
            ]);

        $casestudy = new CaseStudy;
        $casestudy->name = $request->input('name');
        $casestudy->instruction = $request->input('instruction');
        $casestudy->issue_points = $request->input('issue_points');
        $casestudy->stakeholder_points = $request->input('stakeholder_points');
        $casestudy->util_points = $request->input('util_points');
        $casestudy->points = (int)$request->input('issue_points') + (int)$request->input('stakeholder_points') + (int)$request->input('util_points');
        $casestudy->course_id = $request->input('course_id');
        $casestudy->save();

        //get course and associate it with casestudy
        $course = Course::where('id', $request->input('course_id'))->first();

        if($casestudy->course()->associate($course)){
            $request->session()->flash('success', 'New case study saved');
            
        }else{
            $request->session()->flash('error', 'There was an error adding the case study');
           
        }

        return redirect(route('courses.show', $course->id));

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
        $casestudy = CaseStudy::where('id', $id)->first();
        $user_id = Auth::user()->id;

        $course = Course::where('id', $casestudy->course_id)->first();

        $dashboard = Dashboard::where('case_study_id',$id)->where('user_id',$user_id)->first();

        $dashboards = Dashboard::join('users','dashboards.user_id','=','users.id')
                                ->select('dashboards.name','dashboards.id', 'users.name AS user_name', 'dashboards.user_id', 'dashboards.grade')
                                ->where('case_study_id',$id)->get();

        if(Auth::user()->role()->first()->id == 3){
            return view('student.casestudy')->with('casestudy', $casestudy)
                                            ->with('dashboard', $dashboard)
                                            ->with('course',$course);
        }else{
            return view('casestudy')->with('casestudy', $casestudy)
                                            ->with('dashboards', $dashboards)
                                            ->with('course',$course);
        }

       
       
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
            'name' => 'required',
            'instruction' => 'required',
            'issue_points'=> 'required',
            'util_points'=> 'required',
            'stakeholder_points'=> 'required',
            ]);

        $casestudy = CaseStudy::where('id', $id)->first();
        $casestudy->name = $request->input('name');
        $casestudy->instruction = $request->input('instruction');
        $casestudy->issue_points = $request->input('issue_points');
        $casestudy->stakeholder_points = $request->input('stakeholder_points');
        $casestudy->util_points = $request->input('util_points');
        $casestudy->points = (int)$request->input('issue_points') + (int)$request->input('stakeholder_points') + (int)$request->input('util_points');

        if($casestudy->save()){
            $request->session()->flash('success', 'Case study updated');
            
        }else{
            $request->session()->flash('error', 'There was an error updating the case study');
           
        }

        return redirect(route('courses.show', $casestudy->course_id));
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
        $casestudy = CaseStudy::where('id', $id)->first();
        
        if($casestudy->delete()){
            $request->session()->flash('success','Case study has been deleted');
        }else{
            $request->session()->flash('error', 'There was an error deleting the case study');
        }
        
        return redirect(route('courses.show', $request->input('course_id')));
    }
}
