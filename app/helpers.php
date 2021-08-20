<?php
function connection()
{
    $conn_string='tcps://adb.us-ashburn-1.oraclecloud.com:1522/g04c2a7b839f0be_db202107090940_high.adb.oraclecloud.com?
wallet_location=/instantclient_19_11/network/admin&retry_delay=3';
    return $conn = oci_connect('ADMIN', 'OracleOracle2021#', $conn_string);
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

