<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Milestone;

class StatmentController extends Controller
{
    public function insertRowsPrj1(){        
        DB::table('demo_tasks')->insert(['project_id'=>1,'assignee'=>12,'name'=>'Configure Web Listeners',
      'description'=>'Configure the three Web Listeners for Application Express to support the Dev, QA, and Prod environments.',
    'milestone_id'=> null, 'is_complete_yn'=>'Y','start_date'=> date_format(date_create('2014-12-01'),'Y-m-d'),'end_date'=>date_format(date_create('2014-12-15'),'Y-m-d')]);
        
        DB::table('demo_tasks')->insert(['project_id'=>1,'assignee'=>5,'name'=>'Install Application Express',
        'description'=>'Install the latest version of Application Express from OTN (http://www.oracle.com/technetwork/developer-tools/apex/downloads/index.html) into the Oracle Databases for Development, QA, and Production.
        Note: FOr QA and Production Application Express should be configured as "run time" only.',
      'milestone_id'=> null, 'is_complete_yn'=>'Y','start_date'=> date_format(date_create('2014-12-01'),'Y-m-d'),'end_date'=>date_format(date_create('2014-12-15'),'Y-m-d')]);
        
      
      DB::table('demo_tasks')->insert(['project_id'=>1,'assignee'=>5,'name'=>'Define Workspaces',
        'description'=>'Define workspaces needed for different application development teams.
        It is important that access be granted to the necessary schemas and/or new schemas created as appropriate.
        Then export these workspaces and import them into QA and Prod environments.',
      'milestone_id'=> null, 'is_complete_yn'=>'Y','start_date'=> date_format(date_create('2014-12-01'),'Y-m-d'),'end_date'=>date_format(date_create('2014-12-09'),'Y-m-d')]);
      
      DB::table('demo_tasks')->insert(['project_id'=>1,'assignee'=>5,'name'=> 'Assign Workspace Administrators',
      'description'=>'In development assign a minimum of two Workspace administators to each workspace.
      These administrators will then be responsible for maintaining developer access within their own workspaces.',
    'milestone_id'=> null, 'is_complete_yn'=>'N','start_date'=> date_format(date_create('2014-12-01'),'Y-m-d'),'end_date'=>date_format(date_create('2014-12-19'),'Y-m-d')]);
    
      return view('welcome');
    }
    public function insertRowsPrj2(){
      $project=Project::create(['name'=>'Train Developers on Application Express',
      'description'=>'Ensure all developers who will be developing with Oracle Application Express get the appropriate training.',
      'project_lead'=> 1,
      'completed_date'=>date_format(date_create('2014-12-26'),'Y-m-d')
      , 'status'=>'Completed']);

      return $project->id;
    }
    //se apeleaza prima
    public function insertRowsMilestone(){
      $prj_id=$this->insertRowsPrj2();

      $milestone=Milestone::create(['project_id'=>$prj_id
      , 'name'=>'Train the Trainers'
      , 'description'=>'Rather than all developers being trained centrally a select group will be trained.
      THese people will then be responsible for training other developers in their group.'
      , 'due_date'=>date_format(date_create('2014-12-11'),'Y-m-d')
     ]);   
     $this->insertTaskPrj2($prj_id,$milestone->id);
      return view('welcome');
    }
    public function insertTaskPrj2($prj_id, $mile_id){

      DB::table('demo_tasks')->insert(['project_id'=>$prj_id
      , 'assignee'=>6
      , 'name'=>'Prepare Course Outline'
      , 'description'=>'Creation of the training syllabus'
      , 'milestone_id'=>$mile_id
      , 'is_complete_yn'=>'Y'
      , 'start_date'=>date_format(date_create('2014-12-01'),'Y-m-d')
      , 'end_date'=>date_format(date_create('2014-12-11'),'Y-m-d')]);
      
      DB::table('demo_tasks')->insert(['project_id'=>$prj_id
      , 'assignee'=>6
      , 'name'=> 'Write Training Guide'
      , 'description'=>'Produce the powerpoint deck (with notes) for the training instructor.'
      , 'milestone_id'=>$mile_id
      , 'is_complete_yn'=>'N'
      , 'start_date'=>date_format(date_create('2014-12-21'),'Y-m-d')
      , 'end_date'=>date_format(date_create('2014-12-29'),'Y-m-d')]);

      DB::table('demo_tasks')->insert(['project_id'=>$prj_id
      , 'assignee'=>6
      , 'name'=> 'Develop Training Exercises'
      , 'description'=>'Create scripts for sample data and problem statements with solutions.'
      , 'milestone_id'=>$mile_id
      , 'is_complete_yn'=>'Y'
      , 'start_date'=>date_format(date_create('2014-12-01'),'Y-m-d')
      , 'end_date'=>date_format(date_create('2014-12-21'),'Y-m-d')]);

      DB::table('demo_tasks')->insert(['project_id'=>$prj_id
      , 'assignee'=>6
      , 'name'=> 'Conduct Train-the-Trainer session'
      , 'description'=>'Give the training material to the selected developers.'
      , 'milestone_id'=>$mile_id
      , 'is_complete_yn'=>'Y'
      , 'start_date'=>date_format(date_create('2014-12-11'),'Y-m-d')
      , 'end_date'=>date_format(date_create('2014-12-21'),'Y-m-d')]);

      return null;

    }
}
