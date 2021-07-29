<?php
function retunrTotalY()
{
   // $id=App\Models\Project::where('name',$name)->value('id');
   // $total=App\Models\Task::where(['project_id'=>$id,'is_complete_yn'=>'Y'])->count();
   $total=App\Models\Project::from ('demo_projects as p')
   ->join('demo_tasks  as t','p.id','=','t.project_id')
   ->select('p.name', DB::raw('count(t.id) as total'))
   ->where('is_complete_yn','=','Y')      
   ->groupBy('p.name')
   ->pluck('count(t.id) as total');
    return $total;
}

function retunrTotalN()
{
    //$id=App\Models\Project::where('name',$name)->value('id');
    //$total=App\Models\Task::where(['project_id'=>$id,'is_complete_yn'=>'N'])->count();
    $total=App\Models\Project::from ('demo_projects as p')
    ->join('demo_tasks  as t','p.id','=','t.project_id')
    ->select('p.name', DB::raw('count(t.id) as total'))
    ->where('is_complete_yn','=','N')      
    ->groupBy('p.name')
    ->pluck('count(t.id) as total');
    return $total;
}