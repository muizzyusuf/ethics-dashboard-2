<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use App\Models\Dashboard;


class CourseUserController extends Controller
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
        $status = false;

        $this->validate($request, [
            'user'=> 'required|array|min:1',
            ]);
        
        $users = $request->input('user');

        foreach($users as $user){
                
            $courseUser = new CourseUser;
            $courseUser->course_id = $request->input('course_id');
            $courseUser->user_id = $user;

            if($courseUser->save()){
                $status=true;
            }else{
                $status=false;
            }
        }

        if($status){
            $request->session()->flash('success', 'New user added to course');
            
        }else{
            $request->session()->flash('error', 'There was an error adding the user to the course');
           
        }

        return redirect(route('courses.people', $request->input('course_id')));


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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cid, $uid)
    { 
        //
        $courseUser = CourseUser::where('user_id', $uid)->where('course_id', $cid);

        $dashboards = User::find($uid)->dashboards()->delete();
  
        if($courseUser->delete()){
            $request->session()->flash('success','User has been removed from course');
        }else{
            $request->session()->flash('error', 'There was an error removing the user from the course');
        }

        return redirect(route('courses.people', $cid));
    }
}
