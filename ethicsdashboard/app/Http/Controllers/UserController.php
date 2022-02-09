<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
        $user = User::where('id', $id)->first();

        
        return view('user')->with('user',$user);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            ]);
        
        $user = User::where('id', $id)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if( $user->save()){
            $request->session()->flash('success', 'User updated!');
            
        }else{
            $request->session()->flash('error', 'There was an error updating the user');
           
        }

        return redirect(route('user.show',$id));
        
    }

    public function password(Request $request, $id)
    {
        //
        $this->validate($request, [
            'old_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
            ]);
        
        $user = User::where('id', $id)->first();

        if (Hash::check($request->input('old_password'), $user->password)) { 
            
            $user->fill(['password' => Hash::make($request->input('new_password'))])->save();
            
            $request->session()->flash('success', 'Password changed!');

        }else{
            $request->session()->flash('error', 'Old password is incorrect');
        }


        return redirect(route('user.show',$id));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
