<?php
function connection()
{
    $conn_string='tcps://adb.us-ashburn-1.oraclecloud.com:1522/g04c2a7b839f0be_db202107090940_high.adb.oraclecloud.com?
wallet_location=/instantclient_19_11/network/admin&retry_delay=3';
    return $conn = oci_connect('ADMIN', 'OracleOracle2021#', $conn_string);
}


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
function setConn()
{
    $conn_string='tcps://adb.us-ashburn-1.oraclecloud.com:1522/g04c2a7b839f0be_db202107090940_high.adb.oraclecloud.com?
        wallet_location=/instantclient_19_11/network/admin&retry_delay=3';

    $conn = oci_connect('ADMIN', 'OracleOracle2021#', $conn_string);
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    else {
        return $conn;
    }

}

