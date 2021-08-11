<?php

$conn = oci_connect(session('username'),session('password'),session('conn_string'));

$data = array();
$stid = oci_parse($conn, 'SELECT * FROM demo_tasks ORDER BY id');
oci_execute($stid);

while ($row = oci_fetch_object($stid)) {
    $data[] = array(
        'id'   => $row->ID,
        'title'   => $row->NAME,
        'start'   => $row->START_DATE,
        'end'   => $row->END_DATE
    );
}

echo json_encode($data);
?>
