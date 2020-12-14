<?php
require "Config.php";

$GameImage = $_FILES['image'];
$GameImageName = $GameImage['name'];
$GameImageTMP = $GameImage['tmp_name'];
$GameImageSize = $GameImage['size'];
$GameImageError = $GameImage['error'];
$GameImageType = $GameImage['type'];

$GameImageExt = explode('.',$GameImageName);
$GameImageRealExt = strtolower(end($GameImageExt));

$allowed = array('jpg','jpeg','png');

if (in_array($GameImageRealExt,$allowed)){
    if ($GameImageError ==0){
        if ($GameImageSize < 1000001){
            $GameImagNewName = uniqid('',true).".".$GameImageRealExt;
            $ImageLocation = "Image/".$GameImagNewName;
            move_uploaded_file($GameImageTMP,$ImageLocation);

            $GameName = $_POST['GameName'];
            $GameType = $_POST['GameType'];
            $GameTime = $_POST['GameTime'];


            $query = "INSERT INTO `Games`(`GameType`, `GameID`, `GameName`, `TimePlayed`,`image`) 
          VALUES ('$GameType',NULL,'$GameName','$GameTime','$GameImagNewName')";

            if (mysqli_query($verbinding, $query)) {
                echo "Game is toegevoegd!<br>";
                echo $query;
                header("location:index.php");
            } else {
                echo "FOUT bij toevoeggen<br><br>";
                echo mysqli_error($verbinding), "<br><br>";
                echo $query;;
            }
        }else{
            echo "je image was te groot";
        }
    }else{
        echo "er was een error";
    }
}else{
    echo"you cannot upload these images";
}


