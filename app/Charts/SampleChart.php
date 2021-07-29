<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Project;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        
        $data1 = '';
        $data2 = '';

        //$projects=Project::pluck('name');

        $totalY=retunrTotalY();
        $totalN=retunrTotalN();

        foreach ($totalY as $key => $value) {
            $data1 = $data1 .''.$value.',';
        }
        foreach ($totalN as $key => $value) {
            $data2 = $data2 .''.$value.',';
        }
        $data1 = trim($data1,",");      
        $data2 = trim($data2,",");

        return Chartisan::build()
            ->labels(['Tasks'])  
             ->dataset('Train Developers on Application Express', [$data1])
            ->dataset('Configure APEX Environment', [$data2]);
        
            // ->labels(['First', 'Second', 'Third'])
            // ->dataset('Completed', [1, 2, 3])
            // ->dataset('Incompleted', [3, 2, 1]);
           

    }
}