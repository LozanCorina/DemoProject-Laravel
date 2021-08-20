<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Fqsen;
use PHPUnit\Exception;

class BancaController extends Controller
{
    public function getFile($file)
    {
        if(Storage::disk('public')->exists($file)) {
            $path = Storage::disk('public')->path($file);
            $content=file_get_contents($path);
            return response($content)->withHeaders(['Content-Type'=>mime_content_type($path)]);

        }
       return redirect()->route('anexa');
    }


    public function execute(Request $request)
    {
        try {

            $conn = oci_connect(session('username'), session('password'), session('conn_string'));
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            } else {
                $string = $request->code;
                $result = explode(" ", $string, 2);
                $uppCase = mb_convert_case($result[0], MB_CASE_UPPER, "UTF-8");
                if ($uppCase == 'INSERT' || $uppCase == 'DELETE' || $uppCase == 'UPDATE' || $uppCase == 'ALTER') {
                    $stid = oci_parse($conn, $request->code);
                    try {
                        $stid = oci_parse($conn, $request->code);
                        oci_execute($stid);
                        if ($uppCase == 'INSERT') {
                          $rs= oci_num_rows($stid) . ' rows have been inserted</br>';
                            return json_encode(['success'=>$rs]);
                            oci_free_statement($stid);
                        } else if ($uppCase == 'DELETE') {
                            $rs= oci_num_rows($stid) . ' rows have been deleted</br>';
                            return json_encode(['success'=>$rs]);
                            oci_free_statement($stid);
                        }else if($uppCase == 'UPDATE') {
                            $rs = oci_num_rows($stid) . ' rows have been updated</br>';
                            return json_encode(['success' => $rs]);
                            oci_free_statement($stid);
                        }
                        else if ($uppCase == 'ALTER') {
                            $rs =' Table was altered</br>';
                            return json_encode(['success' => $rs]);
                            oci_free_statement($stid);
                        }

                    } catch (\Exception $e) {   //return $e->getMessage();
                        $rs=$e->getMessage();
                        return json_encode(['success'=>$rs]);
                    }
                } else if ($uppCase == 'SELECT') {
                    try {
                        $stid = oci_parse($conn, $request->code);
                        oci_execute($stid);

                        $number_of_rows = oci_fetch($stid);
                        echo $number_of_rows . ' rows have been selected</br>';
                        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                            foreach ($row as $item) {
                                echo($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;");
                            }
                        }
                        oci_free_statement($stid);
                    } catch (\Exception $e) {   //return $e->getMessage();
                        $rs=$e->getMessage();
                        return json_encode(['success'=>$rs]);
                    }
                } else if ($uppCase == 'CREATE') {
                    try {
                        $stid = oci_parse($conn,  $request->code);
                        oci_execute($stid);
                        $string=mb_convert_case($request->code, MB_CASE_UPPER, "UTF-8");
                        if (strpos($string, 'PROCEDURE') !== false) {
                            $rs='Procedure created</br>';
                        }
                        else if(strpos($string, 'FUNCTION') !== false) {
                            $rs='Function created</br>';
                        }
                        else if(strpos($string, 'TABLE') !== false) {
                            $rs='Table created</br>';
                        } else if(strpos($string, 'TRIGGER') !== false) {
                            $rs='Trigger created</br>';
                        }
                        else if(strpos($string, 'PACKAGE') !== false) {
                            $rs='Package created</br>';
                        }
                        else $rs='Item created';


                        return json_encode(['success'=>$rs]);
                        oci_free_statement($stid);
                    } catch (\Exception $e) {   //return $e->getMessage();
                       // return redirect()->route('exceptions.oracle')->with('error', $e->getMessage());
                        $rs=$e->getMessage();
                        return json_encode(['success'=>$rs]);
                    }
                } else if ($uppCase == 'DROP') {
                    $stid = oci_parse($conn, $request->code);
                    try {
                        $stid = oci_parse($conn, $request->code);
                        oci_execute($stid);

                        $rs= 'item have been droped</br>';
                        return json_encode(['success'=>$rs]);
                        oci_free_statement($stid);

                    } catch (\Exception $e) {   //return $e->getMessage();
                        //return redirect()->route('exceptions.oracle')->with('error', $e->getMessage());
                        $rs=$e->getMessage();
                        return json_encode(['success'=>$rs]);
                    }
                }
                else if($uppCase == 'BEGIN' || $uppCase =='DECLARE')
                {
                    $stid = oci_parse($conn, $request->code);
                    try {
                        $stid = oci_parse($conn, $request->code);
                        oci_execute($stid);

                        $rs= 'item have been initiated</br>';
                        return json_encode(['success'=>$rs]);
                        oci_free_statement($stid);

                    } catch (\Exception $e) {   //return $e->getMessage();
                        //return redirect()->route('exceptions.oracle')->with('error', $e->getMessage());
                        $rs=$e->getMessage();
                        return json_encode(['success'=>$rs]);
                    }
                }
                else
                {
                    //return redirect()->route('exceptions.oracle')->with('error', 'Incorrect statment!');
                    $rs = 'Incorrect statment!';
                    return json_encode(['success' => $rs]);
                }
            }
        }
        catch (\Exception $e)
        {
           // return redirect()->route('exceptions.oracle')->with('error', $e->getMessage());
            $rs = 'Incorrect statment!';
            return json_encode(['success' => $rs]);
        }
    }
}
