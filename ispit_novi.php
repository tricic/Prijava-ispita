<?php
spl_autoload_register();

use Entiteti\Ispit;
use Entiteti\Predmet;

Funkcije::zonaZaAdmine();

$predmeti = Predmet::dohvatiSve();

if (isset($_POST["novi"]))
{
    $ispit = new Ispit();
    $ispit->predmet_id = $_POST["predmet_id"];
    $ispit->opis = $_POST["opis"];
    $ispit->datum = str_replace("T", " ", $_POST["datum"]);
    $ispit->rok_prijave = str_replace("T", " ", $_POST["rok_prijave"]);
    $ispit->aktivan = isset($_POST["aktivan"]);
    $ispit->unesi();
}
?>
<html>
    <?php require("partials/head.php") ?>
    
    <body>
        <?php require("partials/header.php") ?>

        <form action="ispit_novi.php" method="post">
            <label>Predmet:</label>
            <select name="predmet_id">
                <?php foreach($predmeti as $predmet) : ?>
                    <option value="<?= $predmet->id ?>"><?= $predmet->naziv ?></option>
                <?php endforeach ?>
            </select>
            
            <br>

            <label>Opis:</label>
            <input type="text" name="opis">

            <br>

            <label>Datum:</label>
            <input type="datetime-local" name="datum">

            <br>

            <label>Rok prijave:</label>
            <input type="datetime-local" name="rok_prijave">

            <br>

            <label>Aktivan:</label>
            <input type="checkbox" name="aktivan" checked>

            <br>
            <input type="submit" name="novi" value="Potvrdi">
        </form>

        <?php require("partials/footer.php") ?>
    </body>
</html>