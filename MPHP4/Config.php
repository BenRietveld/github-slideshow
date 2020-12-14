<?php
$localhost = "127.0.0.1";
$db_hostname = "84860";
$db_password = "cfvg87#$12";
$db_database = "Back-84860";

$verbinding = mysqli_connect($localhost,$db_hostname,$db_password,$db_database);

if (!$verbinding){
    echo "Er is geen verbinding";
}