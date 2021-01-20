<?php

$dbhost = "localhost";
$dbuser = "id14379357_webdevproj2020";
$dbpass = "?n??-cf1Ru/AcBd#";
$dbname = "id14379357_aflmw";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    echo "Connection Failed!";
}
