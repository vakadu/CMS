<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "sachin10";
$db['db_name'] = "b2c_cms";

foreach ($db as $key => $value){
    define(strtoupper($key), $value);
}//we are converting keys as uppercase

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
