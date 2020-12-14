<?php
require "Config.php";

$ID = $_GET['ID'];

$query = "SELECT `GameType`, `GameID`, `GameName`, `TimePlayed`,`GameID`,`image` FROM `Games` WHERE `GameID` = '$ID'";

$resultaat = mysqli_query($verbinding, $query);
if (mysqli_num_rows($resultaat) == 0) {
    echo "<p>Er zijn geen resultaten gevonden</p>";
} else {

    $rij = mysqli_fetch_array($resultaat);
    ?>
    <div>
        <form method="post" action="updateverwerken.php" enctype="multipart/form-data">
            <input hidden name="ID" type="text" value="<?php echo $rij['GameID']; ?>">
            <label for="GameName">Hoe heet de game</label>
            <input type="text" name="GameName" value="<?php echo $rij['GameName']; ?>">

            <label for="GameType">Wat is het type van de game</label>
            <select name="GameType">
                <option value="<?php echo $rij['GameType']; ?>"><?php echo $rij['GameType']; ?></option>
                <option value="RPG">RPG</option>
                <option value="MMO">MMO</option>
                <option value="MMORPG">MMORPG</option>
                <option value="LooterShooter">LooterShooter</option>
            </select>

            <label for="GameTime">Hoe lang heb je deze game gespeelt?</label>
            <input type="number" name="GameTime" value="<?php echo $rij['TimePlayed']; ?>">

            <label for="image">Voer hier uw image toe</label>
            <input type="file" id="image" name="image">
            <input hidden type="text" name="imageOld" value="<?php echo $rij['image']; ?>">

            <input type="submit" value="Update">
        </form>
    </div>
    <?php
}
?>