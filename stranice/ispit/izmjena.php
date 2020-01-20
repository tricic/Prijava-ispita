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
<form action="?akcija=ispit/izmjena&id=<?= $ispit->id ?>" method="post">
    <fieldset>
        <legend>Podaci ispita</legend>

        <label>Predmet</label>
        <br>
        <select name="predmet_id">
            <?php foreach($predmeti as $predmet) : ?>
                <option value="<?= $predmet->id ?>" <?= $predmet->id == $ispit->predmet_id ? "selected" : null ?>>
                    <?= $predmet->naziv ?>
                </option>
            <?php endforeach ?>
        </select>
        
        <br>

        <label>Opis</label>
        <br>
        <input type="text" name="opis" value="<?= $ispit->opis ?>">

        <br>

        <label>Datum</label>
        <br>
        <input type="datetime-local" name="datum" value="<?= str_replace(" ", "T", $ispit->datum) ?>">

        <br>

        <label>Rok prijave</label>
        <br>
        <input type="datetime-local" name="rok_prijave" value="<?= str_replace(" ", "T", $ispit->rok_prijave) ?>">

        <br>

        <label>Maksimalno prijavljenih korisnika</label>
        <input type="number" name="max_korisnika" value="<?= $ispit->max_korisnika ?>">

        <br>

        <label>Maksimalan broj bodova</label>
        <input type="number" name="max_bodova" value="<?= $ispit->max_bodova ?>">

        <br>

        <label>Aktivan</label>
        <br>
        <input type="checkbox" name="aktivan" <?= $ispit->aktivan ? "checked" : null ?>>
    </fieldset>

    <br>
    <div style="text-align: right;">
        <input type="submit" name="izmjena" value="Spremi promjene" class="btn green">
        <a href="?akcija=ispit/brisanje&id=<?= $ispit->id ?>" class="btn red">Izbriši ispit</a>
    </div>
</form>

<h3>
    Lista prijavljenih (<?= $broj_prijavljenih . "/" . $ispit->max_korisnika ?>)
    &nbsp;
    <?php if ($broj_prijavljenih) : ?>
        <a href="?akcija=ispit/odjava&id=<?= $ispit->id ?>&odjavi_sve" class="btn btn-small red">Odjavi sve</a>
    <?php endif ?>
</h3>
<input type="text" onkeyup="filtrirajTabelu(this, 'tabela_prijavljenih')" placeholder="Filtriraj tabelu...">
<table style="margin-top: 20px;" id="tabela_prijavljenih">
    <thead>
        <th style="width: 5%;">R.br.</th>
        <th style="width: 35%;">Ime</th>
        <th>Prezime</th>
        <th style="width: 20%;">Opcije</th>
    </thead>
    <tbody>
        <?php foreach ($prijavljeni_korisnici as $korisnik) : ?>
            <tr>
                <td><?= $rbr ?></td>
                <td><?= $korisnik->ime ?></td>
                <td><?= $korisnik->prezime ?></td>
                <td><a href="?akcija=ispit/odjava&id=<?= $ispit->id ?>&kid=<?= $korisnik->id ?>" class="btn btn-small red">Odjavi</a></td>
            </tr>
        <?php $rbr++; endforeach ?>
    </tbody>
</table>