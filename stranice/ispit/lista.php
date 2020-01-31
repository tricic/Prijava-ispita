<?php

use Entiteti\Ispit;
use Helpers\Auth;

Auth::adminZona();

$ispiti = Ispit::dohvatiSve();

$aktivni_ispiti = Ispit::dohvatiSve("aktivan", 1);
$neaktivni_ispiti = Ispit::dohvatiSve("aktivan", 0);
?>
<fieldset class="mb-3">
    <a href="?akcija=ispit/unos" class="btn btn-success">Novi ispit</a>
</fieldset>

<h5>Aktivni ispiti:</h5>
<input type="text" class="form-control mb-2" onkeyup="filtrirajTabelu(this, 'aktivni_ispiti')" placeholder="Filtriraj tabelu...">
<table class="table table-sm table-bordered mb-3" id="aktivni_ispiti">
    <thead>
        <tr>
            <th>God.</th>
            <th>Sem.</th>
            <th style="width: 30%;">Predmet</th>
            <th>Opis</th>
            <th>Rok prijave</th>
            <th>Datum ispita</th>
            <th>Br. prijava</th>
            <th>Opcije</th>
        </tr>
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
                <td class="<?= $rok_istekao ? 'text-danger' : null ?>"><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                <td class="<?= $datum_istekao ? 'text-danger' : null ?>"><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                <td><?= count($ispit->prijavljeniKorisnici()) . "/" . $ispit->max_korisnika ?>
                <td>
                    <a href="?akcija=ispit/izmjena&id=<?= $ispit->id ?>" class="btn btn-sm btn-primary">Pogledaj</a>
                    <a href="?akcija=ispit/brisanje&id=<?= $ispit->id ?>" class="btn btn-sm btn-danger">Izbriši</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<br>

<h5>Neaktivni ispiti:</h5>
<input type="text" class="form-control mb-2" onkeyup="filtrirajTabelu(this, 'neaktivni_ispiti')" placeholder="Filtriraj tabelu...">
<table class="table table-sm table-bordered mb-4" id="neaktivni_ispiti">
    <thead>
        <tr>
            <th>God.</th>
            <th>Sem.</th>
            <th style="width: 30%;">Predmet</th>
            <th>Opis</th>
            <th>Rok prijave</th>
            <th>Datum ispita</th>
            <th>Br. prijava</th>
            <th>Opcije</th>
        </tr>
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
                <td class="<?= $rok_istekao ? 'text-danger' : null ?>"><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                <td class="<?= $datum_istekao ? 'text-danger' : null ?>"><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                <td><?= count($ispit->prijavljeniKorisnici()) . "/" . $ispit->max_korisnika ?>
                <td>
                    <a href="?akcija=ispit/izmjena&id=<?= $ispit->id ?>" class="btn btn-sm btn-primary">Pogledaj</a>
                    <a href="?akcija=ispit/brisanje&id=<?= $ispit->id ?>" class="btn btn-sm btn-danger">Izbriši</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>