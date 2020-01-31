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
<fieldset class="mb-4">
    <form action="?akcija=ispit/unos" method="POST">
        <div class="form-group">
            <label>Predmet</label>
            <select name="predmet_id" class="form-control">
                <?php foreach($predmeti as $predmet) : ?>
                    <option value="<?= $predmet->id ?>">
                        <?= $predmet->naziv ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Opis</label>
            <input type="text" name="opis" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Datum</label>
            <input type="datetime-local" name="datum" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Rok prijave</label>
            <input type="datetime-local" name="rok_prijave" class="form-control">
        </div>

        <div class="form-group">
            <label>Maksimalno prijavljenih korisnika</label>
            <input type="number" name="max_korisnika" class="form-control">
        </div>

        <div class="form-group">
            <label>Maksimalan broj bodova</label>
            <input type="number" name="max_bodova" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="aktivan" id="aktivan_checkbox" checked>
            <label class="form-check-label" for="aktivan_checkbox">Aktivan</label>
        </div>
        
        <input type="submit" name="unos" value="Potvrdi" class="btn btn-success">
    </form>
</fieldset>
