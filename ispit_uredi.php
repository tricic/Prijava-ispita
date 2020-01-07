<?php
spl_autoload_register();

use Entiteti\Ispit;
use Entiteti\Predmet;

$ispit_id = $_GET["id"] ?? 0;
$ispit = Ispit::dohvati("id", $ispit_id);
$predmeti = Predmet::dohvatiSve();
$prijavljeni_korisnici = $ispit->prijavljeniKorisnici();
$rbr = 1;

if (is_null($ispit))
{
    header("Location: /index.php?greska=Ispit_nije_nađen");
}

if (isset($_POST["spremi_promjene"]))
{
    $ispit->predmet_id = $_POST["predmet_id"];
    $ispit->opis = $_POST["opis"];
    $ispit->datum = str_replace("T", " ", $_POST["datum"]);
    $ispit->rok_prijave = str_replace("T", " ", $_POST["rok_prijave"]);
    $ispit->aktivan = isset($_POST["aktivan"]);
    $ispit->azuriraj();
}
?>
<html>
    <?php require("partials/head.php") ?>
    
    <body>
    <?php require("partials/header.php") ?>

    <form action="ispit_uredi.php?id=<?= $ispit->id ?>" method="post">
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
            <input type="checkbox" name="aktivan" checked>
        </fieldset>

        <br>
        <div style="text-align: right;">
            <input type="submit" name="spremi_promjene" value="Spremi promjene" class="btn green">
        </div>
    </form>

    <h3>Lista prijavljenih (<?= count($prijavljeni_korisnici) ?>)</h3>
    <table style="margin-top: 20px;">
            <thead>
                <tr>
                <th width=20>R.br.</th>
                <th>Ime</th>
                <th>Prezime</th>
            </thead>
            <tbody>
                <?php foreach ($prijavljeni_korisnici as $korisnik) : ?>
                    <tr>
                        <td><?= $rbr ?></td>
                        <td><?= $korisnik->ime ?></td>
                        <td><?= $korisnik->prezime ?></td>
                    </tr>
                <?php $rbr++; endforeach ?>
            </tbody>
        </table>

        <?php require("partials/footer.php") ?>
    </body>
</html>