<?php

// $dbhost = "50.87.236.238";
$dbhost = "127.0.0.1";
$dbuser = "root";
$dbpass = "root";
$dbname_ln = "loneson6_ln";
$dbname_ac = "loneson6_ac";
$dbname_alexcatalano = "loneson6_alexcatalano";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname_ln);
$connection_ac = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname_ac);
$connection_alexcatalano = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname_alexcatalano);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

?>