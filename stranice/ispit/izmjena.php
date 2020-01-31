<?php

use Entiteti\Ispit;
use Entiteti\Predmet;
use Helpers\Auth;

Auth::adminZona();

$ispit = Ispit::dohvati("id", $_GET["id"] ?? 0);

objekatMoraPostojati($ispit, "Ispit nije pronađen.");

$predmeti = Predmet::dohvatiSve();
$prijavljeni_korisnici = $ispit->prijavljeniKorisnici();
$rbr = 1;
$broj_prijavljenih = count($prijavljeni_korisnici);


if (isset($_POST["izmjena"]))
{
    $ispit->predmet_id = $_POST["predmet_id"];
    $ispit->opis = $_POST["opis"];
    $ispit->datum = str_replace("T", " ", $_POST["datum"]);
    $ispit->rok_prijave = str_replace("T", " ", $_POST["rok_prijave"]);
    $ispit->max_korisnika = $_POST["max_korisnika"];
    $ispit->max_bodova = $_POST["max_bodova"];
    $ispit->aktivan = (int)isset($_POST["aktivan"]);
    $ispit->azuriraj();
    nova_poruka("Promjene spremljene.");
    preusmjeri("ispit/izmjena", ["id" => $ispit->id]);
}
?>
<fieldset class="mb-4">
    <form action="?akcija=ispit/izmjena&id=<?= $ispit->id ?>" method="POST">
        <div class="form-group">
            <label>Predmet</label>
            <select name="predmet_id" class="form-control">
                <?php foreach($predmeti as $predmet) : ?>
                    <option value="<?= $predmet->id ?>" <?= $predmet->id == $ispit->predmet_id ? "selected" : null ?>>
                        <?= $predmet->naziv ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Opis</label>
            <input type="text" name="opis" value="<?= $ispit->opis ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Datum</label>
            <input type="datetime-local" name="datum" value="<?= str_replace(" ", "T", $ispit->datum) ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Rok prijave</label>
            <input type="datetime-local" name="rok_prijave" value="<?= str_replace(" ", "T", $ispit->rok_prijave) ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Maksimalno prijavljenih korisnika</label>
            <input type="number" name="max_korisnika" value="<?= $ispit->max_korisnika ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Maksimalan broj bodova</label>
            <input type="number" name="max_bodova" value="<?= $ispit->max_bodova ?>" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="aktivan" id="aktivan_checkbox" <?= $ispit->aktivan ? "checked" : null ?>>
            <label class="form-check-label" for="aktivan_checkbox">Aktivan</label>
        </div>
        
        <input type="submit" name="izmjena" value="Spremi promjene" class="btn btn-success">
        <a href="?akcija=ispit/brisanje&id=<?= $ispit->id ?>" class="btn btn-danger">Izbriši ispit</a>
    </form>
</fieldset>

<h4>
    Lista prijavljenih (<?= $broj_prijavljenih . "/" . $ispit->max_korisnika ?>):
    <?php if ($broj_prijavljenih) : ?>
        <a href="?akcija=ispit/odjava&id=<?= $ispit->id ?>&odjavi_sve" class="btn btn-sm btn-danger">Odjavi sve</a>
    <?php endif ?>
</h4>

<input type="text" class="form-control mb-2" onkeyup="filtrirajTabelu(this, 'tabela_prijavljenih')" placeholder="Filtriraj tabelu...">

<table class="table table-sm table-bordered mb-4" id="tabela_prijavljenih">
    <thead>
        <th style="width: 1%;">R.br.</th>
        <th style="width: 35%;">Prezime</th>
        <th>Ime</th>
        <th style="width: 1%;">Opcije</th>
    </thead>

    <tbody>
        <?php foreach ($prijavljeni_korisnici as $korisnik) : ?>
            <tr>
                <td><?= $rbr ?></td>
                <td><?= $korisnik->prezime ?></td>
                <td><?= $korisnik->ime ?></td>
                <td><a href="?akcija=ispit/odjava&id=<?= $ispit->id ?>&kid=<?= $korisnik->id ?>" class="btn btn-sm btn-danger">Odjavi</a></td>
            </tr>
        <?php
            ++$rbr;
            endforeach
        ?>
    </tbody>
</table>
