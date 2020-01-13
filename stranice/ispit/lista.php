<?php
namespace Ispit;

use Entiteti\Ispit;

zonaZaAdmine();
$ispiti = Ispit::dohvatiSve();
?>
<a href="?akcija=ispit/unos" class="btn green">Novi ispit</a>

<table style="margin-top: 20px;">
    <thead>
        <th width=1>God.</th>
        <th width=1>Sem.</th>
        <th>Predmet</th>
        <th>Opis</th>
        <th>Rok prijave</th>
        <th>Datum ispita</th>
        <th>Aktivan</th>
        <th>Br. prijava</th>
        <th>Opcije</th>
    </thead>
    <tbody>
        <?php foreach ($ispiti as $ispit) : ?>
            <?php $predmet = $ispit->predmet() ?>
            <tr>
                <td><?= $predmet->godina ?></td>
                <td><?= $predmet->semestar ?></td>
                <td><?= $predmet->naziv ?></td>
                <td><?= $ispit->opis ?></td>
                <td><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                <td><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                <td><?= $ispit->aktivan ?></td>
                <td><?= count($ispit->prijavljeniKorisnici()) ?>
                <td>
                    <a href="?akcija=ispit/izmjena&id=<?= $ispit->id ?>" class="btn btn-small blue">Vidi / Uredi</a>
                    <a href="?akcija=ispit/brisanje&id=<?= $ispit->id ?>" class="btn btn-small red">Izbriši</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>