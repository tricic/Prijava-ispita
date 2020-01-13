<?php

use Entiteti\Ispit;

zonaZaPrijavljene();
$korisnik = prijavljeniKorisnik();
$prijavljeni_ispiti = $korisnik->prijavljeniIspiti();
$aktivni_ispiti = Ispit::dohvatiSveGdje("aktivan", "1");

// Izbaci prijavljene ispite
$aktivni_ispiti = array_filter($aktivni_ispiti, function ($ispit) use ($prijavljeni_ispiti) {
    return in_array($ispit, $prijavljeni_ispiti) == false;
});
?>
<h3>Aktivni ispiti za prijavu:</h3>
<table>
    <thead>
        <th width=1>God.</th>
        <th width=1>Sem.</th>
        <th>Predmet</th>
        <th>Opis</th>
        <th>Rok prijave</th>
        <th>Datum ispita</th>
        <th>Opcije</th>
    </thead>
    <tbody>
        <?php foreach ($aktivni_ispiti as $ispit) : ?>
            <?php $predmet = $ispit->predmet() ?>
            <tr>
                <td><?= $predmet->godina ?></td>
                <td><?= $predmet->semestar ?></td>
                <td><?= $predmet->naziv ?></td>
                <td><?= $ispit->opis ?></td>
                <td><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                <td><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                <td>
                    <a href="?akcija=ispit/prijava&id=<?= $ispit->id ?>" class="btn btn-small green">Prijavi</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<h3>Prijavljeni ispiti:</h3>
<table>
    <thead>
        <th width=1>God.</th>
        <th width=1>Sem.</th>
        <th>Predmet</th>
        <th>Opis</th>
        <th>Rok prijave</th>
        <th>Datum ispita</th>
        <th>Opcije</th>
    </thead>
    <tbody>
        <?php foreach ($prijavljeni_ispiti as $ispit) : ?>
            <?php $predmet = $ispit->predmet() ?>
            <tr>
                <td><?= $predmet->godina ?></td>
                <td><?= $predmet->semestar ?></td>
                <td><?= $predmet->naziv ?></td>
                <td><?= $ispit->opis ?></td>
                <td><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                <td><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                <td>
                    <a href="?akcija=ispit/prijava&id=<?= $ispit->id ?>&odjava" class="btn btn-small red">Odjavi</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>