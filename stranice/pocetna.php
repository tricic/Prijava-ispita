<?php

use Entiteti\Ispit;

$korisnik = prijavljeniKorisnik();
if ($korisnik)
{
    $prijavljeni_ispiti = $korisnik->prijavljeniIspiti();
    $aktivni_ispiti = Ispit::dohvatiSveGdje("aktivan", "1");
    
    // Izbaci prijavljene ispite
    $aktivni_ispiti = array_filter($aktivni_ispiti, function ($ispit) use ($prijavljeni_ispiti) {
        return in_array($ispit, $prijavljeni_ispiti) == false;
    });
}
?>
<?php if ($korisnik == false) : ?>
    <p>Potrebno je da se prijavite da biste koristili aplikaciju.</p>
<?php else : ?>
    <h3>Aktivni ispiti za prijavu:</h3>
    <table>
        <thead>
            <th style="width: 1%;">God.</th>
            <th style="width: 1%;">Sem.</th>
            <th style="width: 35%;">Predmet</th>
            <th>Opis</th>
            <th style="width: 13%;">Rok prijave</th>
            <th style="width: 13%;">Datum ispita</th>
            <th style="width: 5%;">Opcije</th>
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
            <th style="width: 1%;">God.</th>
            <th style="width: 1%;">Sem.</th>
            <th style="width: 35%;">Predmet</th>
            <th>Opis</th>
            <th style="width: 13%;">Rok prijave</th>
            <th style="width: 13%;">Datum ispita</th>
            <th style="width: 5%;">Opcije</th>
        </thead>
        <tbody>
            <?php foreach ($prijavljeni_ispiti as $ispit) : ?>
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
                    <td>
                        <a href="?akcija=ispit/odjava&id=<?= $ispit->id ?>" class="btn btn-small red">Odjavi</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>