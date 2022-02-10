<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Dashboard;

class TaskController extends Controller
{
   

    use AuthenticatesUsers;



    public function exportCsv(Request $request)
    {   
        
        $fileName = 'report.csv';
        //setup get dashboard id from input after like
        //$dashboard = Dashboard::where('id', $request->input('dashboard_id'))->first();
        $dashboard = Dashboard::where('id', 1);

        
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

            foreach ($dashboard as $dash) {
                $row['Name']  = $dash->name;
                $row['ID']    = $dash->id;
            

                fputcsv($file, array($row['Name'], $row['ID']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
