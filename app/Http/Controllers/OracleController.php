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
}
