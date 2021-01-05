<?php
ini_set('error_reporting', E_ALL);

//allows for access to the database

$servername = "localhost";
$dBUsername = "hkvllrfk_dba";
$dBPassword = "**************"; //Changed for github repo
$dBName = "hkvllrfk_recsports";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("Connection Failed: ".mysqli_connect_error());
}
