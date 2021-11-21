<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\EthicalIssue;

class EthicalIssueController extends Controller
{
    public function index($id)
    
        {
    
            return view("ethicalissue")->with('id',$id);
    
        }

        public function store(Request $request, $id)
        {
           
            $request->validate([
                'moreFields.*.issue' => 'required',
            ]);

            $requestarr=$request->all();
            $requestarr=$requestarr['ethicalissues'];
    
            $dash=Dashboard::where('id',$id)->first();
            
            foreach($requestarr as $data){
                $c=EthicalIssue::where('id', $dash->ethical_issue_id)->first();
                $c->issue=$data['issue'];
              
        
                //returns error or success message if new entry is successful
                if($c->save()){
                    $request->session()->flash('success', 'New Ethical Issue Saved');

                }else{
                    $request->session()->flash('error', 'There was an error adding the Ethical Issue');
                }

                $c->save();

                    }
            
            return redirect(route('dashboard.show', $id));
        
    
            return back()->with('success', 'Record Created Successfully.');
    
        }
}
