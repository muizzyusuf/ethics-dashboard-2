<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\StakeholderSection;
use App\Models\UtilitarianismSection;
use App\Models\CareSection;
use App\Models\VirtueSection;
use App\Models\DeontologySection;
use App\Models\User;
use App\Models\CaseStudy;
use App\Models\Stakeholder;
use App\Models\Option;
use App\Models\Course;
use App\Models\Consequence;
use App\Models\Impact;

use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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
    public function downloadPDF(Request $request){
        $dashboard = Dashboard::where('id', $request->input('id'))->first();
        $utilitarianism= UtilitarianismSection::where('id', $dashboard->utilitarianism_section_id)->first();
        $ethicalIssue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $options = Option::where('ethical_issue_id', $dashboard->ethical_issue_id)->get();
        $consequences=[];
        foreach ($options as $option){
            $consequenceList=Consequence::where('option_id',$option->id)->get();
            foreach($consequenceList as $consequence){
                array_push($consequences,$consequence);
            }
        }
        $stakeholders = Stakeholder::where('stakeholder_section_id', $dashboard->stakeholder_section_id)->get();
        $impacts=[];
        foreach ($stakeholders as $stakeholder){
            $impactList=Impact::where('stakeholder_id',$stakeholder->id)->get();
            foreach($impactList as $impact){
                array_push($impacts,$impact);
            }
        }
        
        $deontology= DeontologySection::where('id', $dashboard->deontology_section_id)->first();
        $care= CareSection::where('id', $dashboard->care_section_id)->first();
        $virtue= VirtueSection::where('id', $dashboard->virtue_section_id)->first();
        $user= User::where('id', $dashboard->user_id)->first();
        $case= CaseStudy::where('id', $dashboard->case_study_id)->first();
        $course= Course::where('id', $case->course_id)->first();

        $pdf = PDF::loadView('pdf', compact('dashboard','consequences','impacts','utilitarianism', 'ethicalIssue','options','stakeholders','deontology','care','virtue','user','case','course'),);

        return $pdf->download('testing.pdf');
    }
    public function exportCsv(Request $request)
    {   
        
        $fileName = 'report.csv';
    
        $dashboard = Dashboard::where('id', $request->input('id'))->first();
        $utilitarianism= UtilitarianismSection::where('id', $dashboard->utilitarianism_section_id)->first();
        $ethicalIssue = EthicalIssue::where('id', $dashboard->ethical_issue_id)->first();
        $stakeholder = StakeholderSection::where('id', $dashboard->stakeholder_section_id)->first();
        $deontology= DeontologySection::where('id', $dashboard->deontology_section_id)->first();
        $care= CareSection::where('id', $dashboard->care_section_id)->first();
        $virtue= VirtueSection::where('id', $dashboard->virtue_section_id)->first();
        $user= User::where('id', $dashboard->user_id)->first();
        $case= CaseStudy::where('id', $dashboard->case_study_id)->first();
        $course= Course::where('id', $case->course_id)->first();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Student', 'Course', 'Case Study', 'Dashboard', 'Dashboard ID', 'Section','Grade','Comment');
    
        $callback = function() use($dashboard, $user, $case, $ethicalIssue, $stakeholder, $utilitarianism, $care, $deontology, $virtue, $course, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $row['Student']  = $user->name;
            $row['Course'] = $course->title;
            $row['Case Study']  = $case->name;
            $row['Dashboard'] = $dashboard->name;
            $row['Dashboard ID'] = $dashboard->id;
            $row['Section'] = "Ethical Issue";
            $row['Grade'] = $ethicalIssue->grade;
            $row['Comment'] = $ethicalIssue->comment;

                fputcsv($file, array($row['Student'], $row['Course'], $row['Case Study'], $row['Dashboard'], $row['Dashboard ID'], $row['Section'], $row['Grade'], $row['Comment']));

             $row['Student']  = null;
            $row['Course'] = null;
            $row['Case Study']  = null;
            $row['Dashboard'] = null;
            $row['Dashboard ID'] = null;
            $row['Section'] = "Stakeholder";
            $row['Grade'] = $stakeholder->grade;
            $row['Comment'] = $stakeholder->comment;

                fputcsv($file, array($row['Student'], $row['Course'], $row['Case Study'], $row['Dashboard'], $row['Dashboard ID'], $row['Section'], $row['Grade'], $row['Comment']));

            $row['Student']  = null;
            $row['Course'] = null;
            $row['Case Study']  = null;
            $row['Dashboard'] = null;
            $row['Dashboard ID'] = null;
            $row['Section'] = "Utilitarianism";
            $row['Grade'] = $utilitarianism->grade;
            $row['Comment'] = $utilitarianism->comment;

                fputcsv($file, array($row['Student'], $row['Course'], $row['Case Study'], $row['Dashboard'], $row['Dashboard ID'], $row['Section'], $row['Grade'], $row['Comment']));

            $row['Student']  = null;
            $row['Course'] = null;
            $row['Case Study']  = null;
            $row['Dashboard'] = null;
            $row['Dashboard ID'] = null;
            $row['Section'] = "Care Ethics";
            $row['Grade'] = $care->grade;
            $row['Comment'] = $care->comment;
        
                fputcsv($file, array($row['Student'], $row['Course'], $row['Case Study'], $row['Dashboard'], $row['Dashboard ID'], $row['Section'], $row['Grade'], $row['Comment']));   
            
            $row['Student']  = null;
            $row['Course'] = null;
            $row['Case Study']  = null;
            $row['Dashboard'] = null;
            $row['Dashboard ID'] = null;
            $row['Section'] = "Virtue Ethics";
            $row['Grade'] = $virtue->grade;
            $row['Comment'] = $virtue->comment;
            
                fputcsv($file, array($row['Student'], $row['Course'], $row['Case Study'], $row['Dashboard'], $row['Dashboard ID'], $row['Section'], $row['Grade'], $row['Comment']));
            
            $row['Student']  = null;
            $row['Course'] = null;
            $row['Case Study']  = null;
            $row['Dashboard'] = null;
            $row['Dashboard ID'] = null;
            $row['Section'] = "Deontology";
            $row['Grade'] = $deontology->grade;
            $row['Comment'] = $deontology->comment;
                
                fputcsv($file, array($row['Student'], $row['Course'], $row['Case Study'], $row['Dashboard'], $row['Dashboard ID'], $row['Section'], $row['Grade'], $row['Comment']));
                         
                
            

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
