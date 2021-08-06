<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\Milestone;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\PDO;
class DataController extends Controller
{
    public function projects(){
        $prj=Project::all();
        // foreach($prj as $p)
        // {
        //     echo $p->id;
        // }
        return view('projects',compact(['prj']));
    }
    public function tasks(){
            $tasks=Task::all();
            return view('tasks',compact(['tasks']));
    }
    public function team(){
        $teams=Team::all();
        return view('teams',compact(['teams']));
    }
    public function milestones(){
        $mile=Milestone::all();
        return view('milestones',compact(['mile']));
    }
    public function index(){

        return view('statment');
    }
    //team
    public function store_team(Request $request){
        Team::create($request->all());
        return redirect()->route('crud')->with('success_message','Succes!');
    }
    public function delete_team($id){
        Team::find($id)->delete();
        return redirect()->route('team')->with('success_message','Succes!');
    }
    public function update_team(Request $request){
        $team  = Team::find($request->id);
        $team->fill($request->all())->save();
       // Team::where('id',$request->id)->update($request->all());

        return redirect()->route('team')->with('success_message','Updated with succes!');
    }
    //proj
    public function store_project(Request $request){
        Project::create($request->all());
        return redirect()->route('crud')->with('success_message','Succes!');
    }
    public function delete_project($id){
        Project::find($id)->delete();
        return redirect()->route('projects')->with('success_message','Succes!');
    }
    public function update_project(Request $request){
        $pro  = Project::find($request->id);
        $pro->fill($request->all())->save();
        return redirect()->route('projects')->with('success_message','Updated with succes!');
    }
    //task
    public function store_task(Request $request){
        Task::create($request->all());
        return redirect()->route('crud')->with('success_message','Succes!');
    }
    public function delete_task($id){
        Task::find($id)->delete();
        return redirect()->route('tasks')->with('success_message','Succes!');
    }
    public function update_task(Request $request){
        $t  = Task::find($request->id);
        $t->fill($request->all())->save();
        return redirect()->route('tasks')->with('success_message','Updated with succes!');
    }
    //mile
    public function store_mile(Request $request){
        Milestone::create($request->all());
        return redirect()->route('crud')->with('success_message','Succes!');
    }
    public function delete_mile($id){
        milestone::find($id)->delete();
        return redirect()->route('milestones')->with('success_message','Succes!');
    }
    public function update_mile(Request $request){
        $t  = Milestone::find($request->id);
        $t->fill($request->all())->save();
        return redirect()->route('milestones')->with('success_message','Updated with succes!');
    }
    //update
    public function update($model, Request $request){
      if($model =='Team')
      {
        $d=Team::find($request->id);
        return view('update_team',compact(['d']));
      }
      else if($model =="Project"){
        $d=Project::find($request->id);
        return view('update_project',compact(['d']));
      }
      else if($model =="Task"){
        $d=Task::find($request->id);
        return view('update_task',compact(['d']));
      }
      else if($model =="Milestone"){
        $d=Milestone::find($request->id);
        return view('update_milestone',compact(['d']));
      }
       // return redirect()->back()->with('success_message','Updated!');

    }

    public function worksheet(Request $request)
    {
        if($request->isMethod('get')) {
            $query='';
            $data=null;
            $columns=null;

            return view('sqlWork',compact('data','query','columns'));
        }
        else if($request->isMethod('post')) {

            $query=$request->code;
            $data= DB::select(DB::raw($request->code));

            //get columns
            $db = DB::connection()->getPdo();
            $rs = $db->query($request->code);
            for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columns[] = $col['name'];
            }
            return view('sqlWork',compact('data','query','columns'));
        }


    }
}
