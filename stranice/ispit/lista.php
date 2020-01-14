<?php

use Entiteti\Ispit;
use Helpers\Auth;

Auth::adminZona();

$ispiti = Ispit::dohvatiSve();

$aktivni_ispiti = Ispit::dohvatiSveGdje("aktivan", 1);
$neaktivni_ispiti = Ispit::dohvatiSveGdje("aktivan", 0);
?>
<a href="?akcija=ispit/unos" class="btn green">Novi ispit</a>

<h3>Aktivni ispiti:</h3>
<table style="margin-top: 20px;">
    <thead>
        <th style="width: 1%;">God.</th>
        <th style="width: 1%;">Sem.</th>
        <th style="width: 27%;">Predmet</th>
        <th>Opis</th>
        <th style="width: 13%;">Rok prijave</th>
        <th style="width: 13%;">Datum ispita</th>
        <th style="width: 1%;">Br. prijava</th>
        <th style="width: 15%;">Opcije</th>
    </thead>
    <tbody>
        <?php foreach ($aktivni_ispiti as $ispit) : ?>
            <?php
                $rok_istekao = $ispit->rokPrijaveIstekao();
                $datum_istekao = $ispit->datumIstekao();
                $predmet = $ispit->predmet();
            ?>
            <tr>
                <td><?= $predmet->godina ?></td>
                <td><?= $predmet->semestar ?></td>
                <td><?= $predmet->naziv ?></td>
                <td><?= $ispit->opis ?></td>
                <td class="<?= $rok_istekao ? 'red-font' : null ?>"><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                <td class="<?= $datum_istekao ? 'red-font' : null ?>"><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                <td><?= count($ispit->prijavljeniKorisnici()) ?>
                <td>
                    <a href="?akcija=ispit/izmjena&id=<?= $ispit->id ?>" class="btn btn-small blue">Pogledaj</a>
                    <a href="?akcija=ispit/brisanje&id=<?= $ispit->id ?>" class="btn btn-small red">Izbriši</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<h3>Neaktivni ispiti:</h3>
<table style="margin-top: 20px;">
    <thead>
        <th style="width: 1%;">God.</th>
        <th style="width: 1%;">Sem.</th>
        <th style="width: 27%;">Predmet</th>
        <th>Opis</th>
        <th style="width: 13%;">Rok prijave</th>
        <th style="width: 13%;">Datum ispita</th>
        <th style="width: 1%;">Br. prijava</th>
        <th style="width: 15%;">Opcije</th>
    </thead>
    <tbody>
        <?php foreach ($neaktivni_ispiti as $ispit) : ?>
            <?php
                $rok_istekao = $ispit->rokPrijaveIstekao();
                $datum_istekao = $ispit->datumIstekao();
                $predmet = $ispit->predmet();
            ?>
            <tr>
                <td><?= $predmet->godina ?></td>
                <td><?= $predmet->semestar ?></td>
                <td><?= $predmet->naziv ?></td>
                <td><?= $ispit->opis ?></td>
                <td class="<?= $rok_istekao ? 'red-font' : null ?>"><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                <td class="<?= $datum_istekao ? 'red-font' : null ?>"><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                <td><?= count($ispit->prijavljeniKorisnici()) ?>
                <td>
                    <a href="?akcija=ispit/izmjena&id=<?= $ispit->id ?>" class="btn btn-small blue">Pogledaj</a>
                    <a href="?akcija=ispit/brisanje&id=<?= $ispit->id ?>" class="btn btn-small red">Izbriši</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>