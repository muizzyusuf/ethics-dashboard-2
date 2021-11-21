<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Stakeholder;
use App\Models\StakeholderSection;

class StakeholderController extends Controller
{
    public function index($id)
    
    {

        return view("stakeholder")->with('id',$id);

    }

    

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request, $id)
    {
       
        $request->validate([
            'moreFields.*.stakeholder' => 'required',
            'moreFields.*.interests' => 'required',
            'moreFields.*.stakeholder_section_id' => 'required'
        ]);

        $requestarr=$request->all();
        array_shift($requestarr);
        
        $requestarr=$requestarr['stakeholders'];
       

        $dash=Dashboard::where('id',$id)->first();
        $s=StakeholderSection::where('id', $dash->stakeholder_section_id)->first();
        //need to be able to associate dashboard and stakeholder section
        //$s->stakeholderSection()->associate($dash);
    
        foreach($requestarr as $data){
            $c=new Stakeholder;
            $c->stakeholder=$data['stakeholder'];
            $c->interests=$data['interests'];
            $c->stakeholder_section_id=$s->id;
    
            //returns error or success message if new entry is successful
            if($c->save()){
                $request->session()->flash('success', 'New Stakeholders saved');

            }else{
                $request->session()->flash('error', 'There was an error adding the Stakeholders');
            }

            $c->save();

                }
        
        return redirect(route('dashboard.show', $id));
    

        return back()->with('success', 'Record Created Successfully.');

    }

}
