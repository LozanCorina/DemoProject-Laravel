<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS', '(description= (retry_count=20)(retry_delay=3)(address=(protocol=tcps)(port=1522)(host=adb.us-ashburn-1.oraclecloud.com))(connect_data=(service_name=g04c2a7b839f0be_db202107090940_high.adb.oraclecloud.com)))'),
        'service_name'   => env('SERVICE_NAME', ''),
        'host'           => env('DB_HOST2', ''),
        'port'           => env('DB_PORT2', '1522'),
        'database'       => env('DB_DATABASE2', ''),
        'username'       => env('DB_USERNAME2', ''),
        'password'       => env('DB_PASSWORD2', ''),
        'charset'        => env('DB_CHARSET2', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
];
