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
    $ispit->aktivan = (int)isset($_POST["aktivan"]);
    $ispit->unesi();
    $poruka = "Ispit kreiran.";
    header("Location: ispit_uredi.php?id=$ispit->id&poruka=$poruka");
}
?>
<html>
    <?php require("partials/head.php") ?>
    
    <body>
        <?php require("partials/header.php") ?>

        <form action="ispit_novi.php" method="post">
            <fieldset>
                <legend>Podaci ispita</legend>

                <label>Predmet</label>
                <br>
                <select name="predmet_id">
                    <?php foreach($predmeti as $predmet) : ?>
                        <option value="<?= $predmet->id ?>">
                            <?= $predmet->naziv ?>
                        </option>
                    <?php endforeach ?>
                </select>
                
                <br>
        
                <label>Opis</label>
                <br>
                <input type="text" name="opis">
        
                <br>
        
                <label>Datum</label>
                <br>
                <input type="datetime-local" name="datum">
        
                <br>
        
                <label>Rok prijave</label>
                <br>
                <input type="datetime-local" name="rok_prijave">
        
                <br>
        
                <label>Aktivan</label>
                <br>
                <input type="checkbox" name="aktivan" checked>
            </fieldset>

            <br>
            <div style="text-align: right;">
                <input type="submit" name="novi" value="Potvrdi" class="btn green">
            </div>
        </form>

        <?php require("partials/footer.php") ?>
    </body>
</html>