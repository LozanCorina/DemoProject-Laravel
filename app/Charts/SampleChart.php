<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Task;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $task=Task::select('name')->pluck('name');

        return Chartisan::build()
            ->labels(['Tasks'])
            ->dataset('Train Developers on Application Express', [5,1])
            ->dataset('Configure APEX Environment', [5,1])
            ->dataset('Migrate .Net Applications', [7,2]);
            // ->labels(['First', 'Second', 'Third'])
            // ->dataset('Completed', [1, 2, 3])
            // ->dataset('Incompleted', [3, 2, 1]);
           

    }
}