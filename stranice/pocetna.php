<?php

use Entiteti\Ispit;
use Helpers\Auth;

$korisnik = Auth::prijavljeniKorisnik();
if ($korisnik)
{
    $prijavljeni_ispiti = $korisnik->prijavljeniIspiti();
    $aktivni_ispiti = Ispit::dohvatiSve("aktivan", "1");
    
    // Izbaci prijavljene ispite
    $aktivni_ispiti = array_filter($aktivni_ispiti, function ($ispit) use ($prijavljeni_ispiti) {
        return in_array($ispit, $prijavljeni_ispiti) == false;
    });
}
?>
<?php if ($korisnik == false) : ?>
    <p>Potrebno je da se prijavite da biste koristili aplikaciju.</p>
<?php else : ?>
    <h5>Aktivni ispiti za prijavu (<?= count($aktivni_ispiti) ?>):</h5>
    <table class="table table-sm table-bordered mb-4">
        <thead>
            <tr>
                <th>God.</th>
                <th>Sem.</th>
                <th style="width: 30%;">Predmet</th>
                <th>Opis</th>
                <th title="Maksimalno bodova">B</th>
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
                    <td><?= $ispit->max_bodova ?></td>
                    <td class="<?= $rok_istekao ? 'text-danger' : null ?>"><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                    <td class="<?= $datum_istekao ? 'text-danger' : null ?>"><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                    <td><?= count($ispit->prijavljeniKorisnici()) . "/" . $ispit->max_korisnika ?>
                    <td>
                        <a href="?akcija=ispit/prijava&id=<?= $ispit->id ?>" class="btn btn-sm btn-success">Prijavi</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h5>Prijavljeni ispiti (<?= count($prijavljeni_ispiti) ?>):</h5>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>God.</th>
                <th>Sem.</th>
                <th style="width: 30%;">Predmet</th>
                <th>Opis</th>
                <th title="Maksimalno bodova">B</th>
                <th>Rok prijave</th>
                <th>Datum ispita</th>
                <th>Br. prijava</th>
                <th>Opcije</th>
            </tr>
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
                    <td><?= $ispit->max_bodova ?></td>
                    <td class="<?= $rok_istekao ? 'text-danger' : null ?>"><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                    <td class="<?= $datum_istekao ? 'text-danger' : null ?>"><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                    <td><?= count($ispit->prijavljeniKorisnici()) . "/" . $ispit->max_korisnika ?>
                    <td>
                        <a href="?akcija=ispit/odjava&id=<?= $ispit->id ?>" class="btn btn-sm btn-danger">Odjavi</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>