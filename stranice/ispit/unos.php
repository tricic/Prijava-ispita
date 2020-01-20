<?php

use Entiteti\Ispit;
use Entiteti\Predmet;
use Helpers\Auth;

Auth::adminZona();

$predmeti = Predmet::dohvatiSve();

if (isset($_POST["unos"]))
{
    $ispit = new Ispit();
    $ispit->predmet_id = $_POST["predmet_id"];
    $ispit->opis = $_POST["opis"];
    $ispit->datum = str_replace("T", " ", $_POST["datum"]);
    $ispit->rok_prijave = str_replace("T", " ", $_POST["rok_prijave"]);
    $ispit->max_korisnika = $_POST["max_korisnika"];
    $ispit->max_bodova = $_POST["max_bodova"];
    $ispit->aktivan = (int)isset($_POST["aktivan"]);
    $ispit->unesi();
    nova_poruka("Ispit kreiran.");
    preusmjeri("ispit/izmjena", ["id" => $ispit->id]);
}
?>
<form action="?akcija=ispit/unos" method="post">
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

        <label>Maksimalno prijavljenih korisnika</label>
        <input type="number" name="max_korisnika">

        <br>

        <label>Maksimalan broj bodova</label>
        <input type="number" name="max_bodova">

        <br>

        <label>Aktivan</label>
        <br>
        <input type="checkbox" name="aktivan" checked>
    </fieldset>

    <br>
    <div style="text-align: right;">
        <input type="submit" name="unos" value="Potvrdi" class="btn green">
    </div>
</form>