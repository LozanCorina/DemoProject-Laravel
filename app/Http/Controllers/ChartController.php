<?php

namespace App\Http\Controllers;
use Chartisan\PHP\Chartisan;
use App\Charts\SampleChart;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class ChartController extends Controller
{
   public function index(){
  
        // $chart = Chartisan::build()
        // ->labels([ '','Tasks'])
        // ->dataset('My tasks',[0,5,10,15,20]);
        // $options = [
        //     'chart_title' => 'Project Tasks',
        //     'report_type' => 'group_by_date',
        //     'model' => 'App\Models\Task',
        //     'group_by_field' => 'created_at',
        //     'group_by_period' => 'month',
        //     'chart_type' => 'bar',
        // ];

        //$chart = new LaravelChart($options);
        $prj=Project::all();
        return view('chart',compact(['prj']));
   }
public function test()
{
    $task=Task::select('name')->pluck('name');
    echo $task;
    // foreach($name as $n)
    // {
    //     echo $n->name;
    // }
}
}
