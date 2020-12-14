<?php
session_start();
$Naam = $_SESSION['naam'];
require "Config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<header>
    <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="loguit.php">Logout</a></li>
    </ul>
    <h3><?php echo $_SESSION['naam']; ?></h3>
</header>
<?php
if (isset($_SESSION['naam'])){
?>
<div>
    <form method="post" action="Create.php" enctype="multipart/form-data">
        <div class="Add">
        <label for="GameName">Hoe heet de game</label>
        <input type="text" name="GameName">

        <label for="GameType">Wat is het type van de game</label>
        <select name="GameType">
            <option value="RPG">RPG</option>
            <option value="MMO">MMO</option>
            <option value="MMORPG">MMORPG</option>
            <option value="LooterShooter">LooterShooter</option>
        </select>

        <label for="GameTime">Hoe lang heb je deze game gespeelt?</label>
        <input type="number" name="GameTime">

            <label for="image">Voer hier uw image toe</label>
            <input type="file" name="image">

        <input type="submit" value="Voeg Nu Toe">
        </div>
    </form>
</div>
<?php
}
?>
<div>
    <?php
        $query = "SELECT `GameType`, `GameID`, `GameName`, `TimePlayed`,`image` FROM `Games`";

        $resultaat = mysqli_query($verbinding, $query);


        if (mysqli_num_rows($resultaat) == 0) {
            echo "<p>Er zijn geen resultaten gevonden</p>";
        } else {

            echo "<table>";
            echo "<tr>";
            echo "<th>Game Name</th>";
            echo "<th>Game Type</th>";
            echo "<th>Game Time</th>";
            echo "</tr>";
            while ($rij = mysqli_fetch_array($resultaat)) {
                echo "<tr>";
                echo "<td>" . $rij['GameName'] . "</td>";
                echo "<td>" . $rij['GameType'] . "</td>";
                echo "<td>" . $rij['TimePlayed'] . "</td>";
                echo "<td><img src='Image/".$rij['image']."'height='100px' width='150px'></td>";
                if (isset($_SESSION['naam'])){
                    echo "<td><a href='update.php?ID=" . $rij['GameID'] . "'>Update</a> </td>";
                    echo "<td><a href='verwijder.php?ID=" . $rij['GameID'] . "'>Verwijder</a> </td>";
                }

                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
</div>
</body>
</html>
