<?php

session_start();
require "Config.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $response = $_POST["g-recaptcha-response"];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => '6Lf7HuIZAAAAABzUVYDoPoU8A3K4JHSsoCGewsKF',
        'response' => $_POST["g-recaptcha-response"]
    );
    $options = array(
        'http' => array (
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success=json_decode($verify);

    if ($captcha_success->success==false) {
        echo "<p>You are a bot! Go away!</p>";
    } else if ($captcha_success->success==true) {
        $Query =
            "SELECT `Name` , `Password`, `UserID` 
         FROM `User` WHERE `Name` = '$username' 
         AND `Password` = '$password'";

        $resultaat = mysqli_query($verbinding, $Query);

        if (mysqli_num_rows($resultaat) > 0) {
            $user = mysqli_fetch_array($resultaat);

            $_SESSION['naam'] = $user['Name'];
            $_SESSION['Level'] = $user['Level'];

            echo "<p>Hallo $username u bent ingelogd!!</p>";
            echo "<p><a href='index.php'>Ga verder</a></p>";
        } else {
            echo $Query;
            echo "<p>Naam en/of wachtwoord zijn onjuist.</p>";
            echo "<p><a href='login.php'>Probeer Opnieuw</a></p>";
        }
    }
}
?>