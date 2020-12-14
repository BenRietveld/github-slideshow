<?php
require "Config.php";

$ID = $_GET['ID'];

$query = "DELETE FROM `Games` WHERE `GameID` = '$ID'";

if (mysqli_query($verbinding, $query)) {
    echo $query;

    header("location:index.php");

} else {
    echo "FOUT bij verwijderen<br><br>";

    echo mysqli_error($verbinding), "<br><br>";

    echo $query;
}
