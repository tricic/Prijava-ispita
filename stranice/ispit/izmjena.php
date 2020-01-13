<?php

use Entiteti\Ispit;
use Entiteti\Predmet;

zonaZaAdmine();

$ispit_id = $_GET["id"] ?? 0;
$ispit = Ispit::dohvati("id", $ispit_id);
$predmeti = Predmet::dohvatiSve();
$prijavljeni_korisnici = $ispit->prijavljeniKorisnici();
$rbr = 1;
$broj_prijavljenih = count($prijavljeni_korisnici);

objekatMoraPostojati($ispit);

if (isset($_POST["izmjena"]))
{
    $ispit->predmet_id = $_POST["predmet_id"];
    $ispit->opis = $_POST["opis"];
    $ispit->datum = str_replace("T", " ", $_POST["datum"]);
    $ispit->rok_prijave = str_replace("T", " ", $_POST["rok_prijave"]);
    $ispit->aktivan = (int)isset($_POST["aktivan"]);
    $ispit->azuriraj();
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

        <label>Aktivan</label>
        <br>
        <input type="checkbox" name="aktivan" <?= $ispit->aktivan ? "checked" : null ?>>
    </fieldset>

    <br>
    <div style="text-align: right;">
        <input type="submit" name="izmjena" value="Spremi promjene" class="btn green">
    </div>
</form>

<h3>
    Lista prijavljenih (<?= $broj_prijavljenih ?>)
    &nbsp;
    <?php if ($broj_prijavljenih) : ?>
        <a href="?akcija=ispit/prijava&id=<?= $ispit->id ?>&odjava&kid=svi" class="btn btn-small red">Odjavi sve</a>
    <?php endif ?>
</h3>
<table style="margin-top: 20px;">
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
                <td><a href="?akcija=ispit/prijava&id=<?= $ispit->id ?>&odjava&kid=<?= $korisnik->id ?>" class="btn btn-small red">Odjavi</a></td>
            </tr>
        <?php $rbr++; endforeach ?>
    </tbody>
</table>