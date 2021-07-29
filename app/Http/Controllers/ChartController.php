<?php

namespace App\Http\Controllers;
use Chartisan\PHP\Chartisan;
use App\Charts\SampleChart;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class ChartController extends Controller
{
   public function index(){
        $prj=Project::all();
        $data1 = '';
        $data2 = '';
        $projects='';
        $totalY=retunrTotalY();
        $totalN=retunrTotalN();

        foreach ($totalY as $key => $value) {
            $data1 = $data1 .''.$value.',';
        }
        foreach ($totalN as $key => $value) {
            $data2 = $data2 .''.$value.',';
        }
        foreach ($prj as $value) {
          $projects = $projects .''.$value->name.',';
        }
        $data1 = trim($data1,",");      
        $data2 = trim($data2,",");
        $projects = trim($projects,",");
        //echo $projects;
     
      return view('chartTest',compact(['data1','data2','prj','projects']));
   }
public function test()
{

    //--------------------
        $data1 = '';
        $data2 = '';
        $totalY=retunrTotalY();
        $totalN=retunrTotalN();

        foreach ($totalY as $key => $value) {
            $data1 = $data1 .''.$value.',';
        }
        foreach ($totalN as $key => $value) {
            $data2 = $data2 .''.$value.',';
        }
       echo $data1 = trim($data1,",");      
      echo  $data2 = trim($data2,",");

    ///////////-----------------
    $projects=Project::pluck('name'); 
   //echo retunrTotalY($projects[0]),retunrTotalN($projects[0]);
 //  echo($projects);

// echo $projects;
    // $proj_name=array();
    // foreach($projects as $key =>$value)
    // {
    //     $proj_name[$key]=$value;
    // }
    //echo $projects[0];
   //echo $id=Project::where('name','Configure APEX Environment')->value('id');
    $tasksN=Project::from ('demo_projects as p')
    ->join('demo_tasks  as t','p.id','=','t.project_id')
    ->select('p.name', DB::raw('count(t.id) as total'))
    ->where('is_complete_yn','=','N')      
    ->groupBy('p.name')
    ->pluck('count(t.id) as total');
    //echo $nrN=Task::where(['project_id'=>1,'is_complete_yn'=>'Y'])->count();
    //  foreach($tasksN as $n)
    //     {
    //         echo $n->name.'<br>';
    //     }
     $tasksY=Project::from ('demo_projects as p')
    ->join('demo_tasks  as t','p.id','=','t.project_id')
    ->select(DB::raw('count(t.id) as total'))
    ->where('is_complete_yn','=','Y')      
    ->groupBy('p.name')
     ->pluck('count(t.id) as total');

   // echo  $tasksN.'<br>'. $tasksY;
  // echo $tasksY;
    // foreach($tasksY as $n)
    //     {
    //         echo $n->name.'->'.$n->total.'<br>';
    //     }
}
}
