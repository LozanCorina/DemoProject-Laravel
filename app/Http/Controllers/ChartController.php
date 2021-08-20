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
        $statment="select  p.name as label
                                , (select count('x') from demo_tasks t
                                   where p.id = t.project_id
       and nvl(t.is_complete_yn,'N') = 'Y'
                                  ) as complete
                                , (select count('x') from demo_tasks t
                                   where p.id = t.project_id
       and nvl(t.is_complete_yn,'N') = 'N'
                                  ) as incomplete
                                from demo_projects p
                                order by p.created_at desc";
       $data= DB::select(DB::raw($statment));
       foreach ($data as $row) {
           $data1 = $data1 .''.$row->complete.',';
           $data2 = $data2 .''.$row->incomplete.',';
           $projects = $projects .'"'.$row->label.'",';
       }
      return view('chartTest',compact(['data1','data2','prj','projects']));
   }
    public function test()
    {
        $data= DB::select(DB::raw('SHOW TABLES'));
        foreach ($data as $d)
        {
            foreach ($d as $item)
            {
                echo $item;
            }
        }
    }
}
