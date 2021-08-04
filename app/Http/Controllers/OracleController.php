<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class OracleController extends Controller
{
    public function index(){
         $conn = oci_connect("ADMIN", "Oracle2021#", "adb.us-ashburn-1.oraclecloud.com/g04c2a7b839f0be_db202107090940_high.adb.oraclecloud.com");
         echo $conn;
        // $data=Project::all();
        // foreach($data as $p){
        //     echo $p->name.'<br>';
        // }
    }
    public function worksheet(Request $request){
            $conn = connection();
            $stid = oci_parse($conn, $request->code);
            oci_execute($stid);
            return view('oracle.worksheet_result',compact(['stid','conn']));
    }
    public function chart()
    {
        $data1 = '';
        $data2 = '';
        $conn = connection();
        $stid = oci_parse($conn, "select count(*) total from demo_projects p join demo_tasks  t on p.id = t.project_id where is_complete_yn='Y' group by p.name order by p.name asc");
        oci_execute($stid);

        //loop through the returned data
        while ($row = oci_fetch_object($stid)) {
            $data1 = $data1 . '"'. $row->TOTAL.'",';
        }
        $st = oci_parse($conn, "select count(*) total from demo_projects p join demo_tasks  t on p.id = t.project_id where is_complete_yn='N' group by p.name order by p.name asc ");
        oci_execute($st);
        while ($row = oci_fetch_object($st)) {
            $data2 = $data2 . '"'. $row->TOTAL.'",';
        }
        $name = oci_parse($conn, "select name from demo_projects");
        oci_execute($name);

        $data1 = trim($data1,",");
        $data2 = trim($data2,",");
        //echo $data1;
       // echo $data2;

        return view('oracle.chart',compact(['data1','data2','name','conn']));
    }
    public function projects()
    {
        $conn = connection();
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            $stid = oci_parse($conn, 'SELECT * FROM demo_projects');
            oci_execute($stid);

            return view('oracle.projects', compact(['conn', 'stid']));
        }
    }
    public  function delete_project($id)
    {
        $conn = connection();
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            $stid = oci_parse($conn, 'Delete from demo_projects where id='.$id);
            oci_execute($stid);
            return redirect()->route('projects.o')->with('success_message','Succes!');
        }
    }
    public function teams()
    {
        $conn = connection();
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            $stid = oci_parse($conn, 'SELECT * FROM demo_team_members');
            oci_execute($stid);

            return  view('oracle.teams', compact(['conn', 'stid']));
        }
    }
    public function destroy($id)
    {
        $conn = connection();
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            $stid = oci_parse($conn, 'Delete from demo_team_members where id='.$id);
            oci_execute($stid);
            return redirect()->route('team.o')->with('success_message','Succes!');
        }
    }
    public function mile()
    {
        $conn = connection();
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            $stid = oci_parse($conn, 'SELECT * FROM demo_milestones');
            oci_execute($stid);

            return view('oracle.milestones', compact(['conn', 'stid']));
        }
    }
    public function tasks()
    {
        $conn = connection();
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            $stid = oci_parse($conn, 'SELECT * FROM demo_tasks');
            oci_execute($stid);

            return view('oracle.tasks', compact(['conn', 'stid']));
        }
    }
    public function del_task($id)
    {
        $conn = connection();
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            $stid = oci_parse($conn, 'Delete from demo_tasks where id='.$id);
            oci_execute($stid);
            return redirect()->route('tasks.o')->with('success_message','Succes!');
        }
    }
    public function del_mile($id)
    {
        $conn = connection();
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            $stid = oci_parse($conn, 'Delete from demo_milestones where id='.$id);
            oci_execute($stid);
            return redirect()->route('milestones.o')->with('success_message','Succes!');
        }
    }
    public function updateData($model, Request $request){
        if($model =='Team')
        {
            $conn = connection();
            $stid = oci_parse($conn, 'SELECT * FROM demo_team_members where id='.$request->id);
            oci_execute($stid);
            return view('oracle.update_team',compact(['conn', 'stid']));
        }
        else if($model =="Project"){
            $conn = connection();
            $stid = oci_parse($conn, 'SELECT * FROM demo_projects where id='.$request->id);
            oci_execute($stid);
            return view('oracle.update_project',compact(['conn', 'stid']));
        }
        else if($model =="Task"){
            $conn = connection();
            $stid = oci_parse($conn, 'SELECT * FROM demo_tasks where id='.$request->id);
            oci_execute($stid);
            return view('oracle.update_task',compact(['conn', 'stid']));
        }
        else if($model =="Milestone"){
            $conn = connection();
            $stid = oci_parse($conn, 'SELECT * FROM demo_milestones where id='.$request->id);
            oci_execute($stid);
            return view('oracle.update_milestone',compact(['conn', 'stid']));
        }

    }
    public function data($table, Request $request){
        if($table =='Team')
        {
            $conn = connection();
            $stid = oci_parse($conn, "Update demo_team_members set username='".$request->username."', full_name='".$request->full_name ."', email='".$request->email."', profile='".$request->profile."', photo_filename='".$request->photo_filename."'where id= ".$request->id);
            oci_execute($stid);
            return redirect()->route('team.o')->with('success_message','Updated with success!');
        }
        else if($table =="Project"){
            $conn = connection();
            $stid = oci_parse($conn, "Update demo_projects set name='".$request->name."', description='".$request->description ."',project_lead=".$request->project_lead.", completed_date=to_date('".$request->completed_date."','YYYY-MM-DD'), status='".$request->status."'  where id=".$request->id);
            oci_execute($stid);
            return redirect()->route('projects.o')->with('success_message','Updated with success!');
        }
        else if($table =="Task"){
            $conn = connection();
            $stid = oci_parse($conn, "Update demo_tasks set assignee=".$request->assignee.", name='".$request->name ."',description='".$request->description ."',project_id=".$request->project_id.", milestone_id=".$request->milestone_id.", is_complete_yn='".$request->is_complete_yn."', start_date=to_date('".$request->start_date."','YYYY-MM-DD'), end_date=to_date('".$request->end_date."','YYYY-MM-DD') where id=".$request->id);
            oci_execute($stid);
            return redirect()->route('tasks.o')->with('success_message','Updated with success!');
        }
        else if($table =="Milestone"){
            $conn = connection();
            $stid = oci_parse($conn, "Update demo_milestones set project_id=".$request->project_id.", name='".$request->name ."', description='".$request->description ."', due_date=to_date('".$request->due_date."','YYYY-MM-DD') where id=".$request->id);
            oci_execute($stid);
            return redirect()->route('milestones.o')->with('success_message','Updated with success!');
        }
    }
}
