<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Option;

class OptionController extends Controller
{
    public function index($id)
    
        {
    
            return view("options")->with('id',$id);
    
        }
        public function store(Request $request, $id)
        {
           
            $request->validate([
                'moreFields.*.option' => 'required',
            ]);

            $requestarr=$request->all();
            
            $requestarr=$requestarr['options'];
           
    
            $dash=Dashboard::where('id',$id)->first();
        
            foreach($requestarr as $data){
                $c=new Option;
                $c->option=$data['option'];
                $c->ethical_issue_id=$dash->ethical_issue_id;
        
                //returns error or success message if new entry is successful
                if($c->save()){
                    $request->session()->flash('success', 'New Options saved');

                }else{
                    $request->session()->flash('error', 'There was an error adding the Options');
                }

                $c->save();

                    }
            
            return redirect(route('dashboard.show', $id));
        
    
            return back()->with('success', 'Record Created Successfully.');
    
        }
}
