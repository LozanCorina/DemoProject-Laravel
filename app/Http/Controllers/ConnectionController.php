<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ConnectionRequest;
use App;

class ConnectionController extends Controller
{
    public function index()
    {

        // $stid = oci_parse(setConn(), 'SELECT * FROM test');
        // oci_execute($stid);

        // echo "<table border='1'>\n";
        // while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //     echo "<tr>\n";
        //     foreach ($row as $item) {
        //         echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        //     }
        //     echo "</tr>\n";
        // }
        // echo "</table>\n";

      // echo  DB::table('test')->get();

            return view('connection');

    }
    public function set(Request $request){
        //$validatedData = $request->validated();
        $username=$request->username;
        if($request->db_type =='mysql')
        {
            if($request->username != config('global.username'))
            {
                return redirect()->route('connection')->with('success_message','Username is incorrect!');
            }
            else if($request->password != config('global.password'))
            {
                return redirect()->route('connection')->with('success_message','Password is incorrect!');
            }
            else if($request->host != config('global.host'))
            {
                //echo $request->host.' '.config('global.host');
                return redirect()->route('connection')->with('success_message','Server is incorrect!');
            }
            else if($request->port != config('global.port'))
            {
                return redirect()->route('connection')->with('success_message','Port is incorrect!');
            }
            else if($request->db!= config('global.database'))
            {
                return redirect()->route('connection')->with('success_message','Database is incorrect!');
            }
            else
            return view('welcome');
        }
        else {

            if ($request->conn_type == 'wallet') {
                try {
                    $conn_string = 'tcps://'.$request->host1.':'.$request->port1.'/' . $request->service_name1 . '?wallet_location='.$request->wallet.'&retry_delay='.$request->delay.'';
                    $conn = oci_connect($request->username, $request->password, $conn_string);
                    if (!$conn) {
                        $e = oci_error();
                        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                    } else {
                        $stid = oci_parse($conn, 'SELECT table_name FROM USER_TABLES');
                        oci_execute($stid);

                        return view('data', compact(['conn', 'stid']));
                    }

                    //$stid = oci_parse($conn, 'SELECT * FROM test');
                } catch (\Prophecy\Exception\Exception $e) {
                    return back()->withError($e->getMessage())->withInput();
                }
            } else if ($request->conn_type == 'basic') {
                try {
                    $conn_string = 'tcps://' . $request->host . ':' . $request->port . '/' . $request->service_name2 . '?wallet_location=/instantclient_19_11/network/admin&retry_delay=3';

                    $conn = oci_connect($request->username, $request->password, $conn_string);
                    if (!$conn) {
                        $e = oci_error();
                        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                    } else {
                        $stid = oci_parse($conn, 'SELECT table_name FROM USER_TABLES');
                        oci_execute($stid);

                        return view('data', compact(['conn', 'stid']));
                    }

                    //$stid = oci_parse($conn, 'SELECT * FROM test');
                } catch (\Prophecy\Exception\Exception $e) {
                    return back()->withError($e->getMessage())->withInput();
                }
            }
        }



    }
}
