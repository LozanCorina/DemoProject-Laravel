<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportImportController extends Controller
{
    public function exportCsvOracle(Request $request){
        if ($request->table !='-') {
            $conn = oci_connect(session('username'),session('password'),session('conn_string'));
            $tableName = $request->table;
            $stid = oci_parse($conn, 'select * from '.$tableName);
            oci_execute($stid);
            $columns = array();

            $ncols = oci_num_fields($stid);
            for ($i = 1; $i <= $ncols; $i++) {
                $columns[] = $column_name = oci_field_name($stid, $i);

            }

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename='.$tableName.'.csv');

            $output = fopen("php://output", "w");
            fputcsv($output, array_values($columns));
            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                fputcsv($output, $row);
            }
            fclose($output);
        }else
        return redirect()->route('export.oracle')->with('success_message','No table selected!');
    }
    public  function exportCsvMysql(Request $request)
    {
        if ($request->table !='-') {
            $tableName = $request->table;
            $connect = mysqli_connect("localhost:3307", "root", "", "unism");
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename='.$tableName.'.csv');
            $output = fopen("php://output", "w");

            $columns = array();
            $db = DB::connection()->getPdo();
            $rs = $db->query('select * from '.$tableName);
            for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columns[] = $col['name'];
            }
            fputcsv($output, array_values($columns));
            $query = "SELECT * from $tableName";
            $result = mysqli_query($connect, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                fputcsv($output, $row);
            }
            fclose($output);


        }
        else
        return redirect()->route('export.mysql')->with('success_message','No table selected!');
    }

    public function exportMysql(Request $request)
    {
        if ($request->table != '-') {
            $table = $request->table;
            $db = mysqli_connect("localhost:3307", "root", "", "unism");

            $return = '';
                $result = $db->query("SELECT * FROM $table");
                $numColumns = $result->field_count;

                /* $return .= "DROP TABLE $table;"; */
                $result2 = $db->query("SHOW CREATE TABLE $table");
                $row2 = $result2->fetch_row();

                $return .= "\n\n" . $row2[1] . ";\n\n";

                for ($i = 0; $i < $numColumns; $i++) {
                    while ($row = $result->fetch_row()) {
                        $return .= "INSERT INTO $table VALUES(";
                        for ($j = 0; $j < $numColumns; $j++) {
                            $row[$j] = addslashes($row[$j]);
                            $row[$j] = $row[$j];
                            if (isset($row[$j])) {
                                $return .= '"' . $row[$j] . '"';
                            } else {
                                $return .= '""';
                            }
                            if ($j < ($numColumns - 1)) {
                                $return .= ',';
                            }
                        }
                        $return .= ");\n";
                    }
                }

                $return .= "\n\n\n";
            header('Content-Type: text/sql; charset=utf-8');
            header('Content-Disposition: attachment; filename='.$table . '.sql');
            $handle = fopen('php://output', 'w+');
            fwrite($handle, $return);
            fclose($handle);
        }
        else
            return redirect()->route('export.mysql')->with('success_message','No table selected!');
    }

}
