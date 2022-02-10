<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\EthicalIssue;
use App\Models\StakeholderSection;
use App\Models\UtilitarianismSection;
use App\Models\CareSection;
use App\Models\User;
use App\Models\CaseStudy;
use App\Models\Stakeholder;
use App\Models\Option;

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

    public function exportCsv(Request $request)
    {   
        
        $fileName = 'report.csv';
        //setup get dashboard id from input after like
        //$dashboard = Dashboard::where('id', $request->input('dashboard_id'))->first();


        $dashboard = Dashboard::where('id', $request->input('id'))->first();

        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'ID');
    
        $callback = function() use($dashboard, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

           
                $row['Name']  = $dashboard->name;
                $row['ID']    = $dashboard->id;
            
                fputcsv($file, array($row['Name'], $row['ID']));
            

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
