<?php

require "Config.php";

$OldImage = $_POST['imageOld'];
unlink("Image/".$OldImage);

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
            $ID = $_POST['ID'];

            $query = "UPDATE `Games` SET 
          `GameType`='$GameType',
          `GameName`='$GameName',
          `TimePlayed`='$GameTime',
          `image` = '$GameImagNewName' 
          WHERE `GameID` = '$ID'";

            if (mysqli_query($verbinding, $query)) {
                header("location:index.php");
            } else {
                echo "FOUT bij updaten<br><br>";
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

    $GameName = $_POST['GameName'];
    $GameType = $_POST['GameType'];
    $GameTime = $_POST['GameTime'];
    $ID = $_POST['ID'];

    $query = "UPDATE `Games` SET 
          `GameType`='$GameType',
          `GameName`='$GameName',
          `TimePlayed`='$GameTime',
          `image` = '$GameImagNewName' 
          WHERE `GameID` = '$ID'";

    if (mysqli_query($verbinding, $query)) {
        header("location:index.php");
    } else {
        echo "FOUT bij updaten<br><br>";
        echo mysqli_error($verbinding), "<br><br>";
        echo $query;;
    }
}



