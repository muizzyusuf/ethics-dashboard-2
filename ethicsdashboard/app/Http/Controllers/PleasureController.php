<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;
use App\Models\Option;
use App\Models\Stakeholder;

class PleasureController extends Controller
{
    public function show($id)
    {
        $user_id = Auth::user()->id;
        $dash=Dashboard::where('id',$id)->first();
        $options=Option::where('ethical_issue_id', $dash->ethical_issue_id)->get();
        $stakeholders=Stakeholder::where('stakeholder_section_id', $dash->stakeholder_section_id)->get();
        //return $options;
        return view('pleasures')->with('dashboard', $dash)
                                            ->with('options', $options)
                                            ->with('stakeholders', $stakeholders);
            //we need to make returned pleasures array also contain
            //associated stakeholder and option
            //create slider inputs
            //repeat for long term
                                        }
    public function store(Request $request, $id)
    {
       
        $request->validate([
            'moreFields.*.pleasure' => 'required',
            'moreFields.*.explanation' => 'required',
            'moreFields.*.option_id' => 'required'
        ]);

        $requestarr=$request->all();
        array_shift($requestarr);
        
        $requestarr=$requestarr['stakeholders'];
       
        $user_id = Auth::user()->id;
        $dash=Dashboard::where('id',$user_id)->first();
        $s=Option::where('ethical_issue_id', $dash->stakeholder_section_id)->first();
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
