<?php
spl_autoload_register();

use Entiteti\{Korisnik, Predmet, Ispit, Ispit_Korisnik};

$korisnik = Korisnik::dohvati(1);
$moji_ispiti = $korisnik->prijavljeniIspiti();
$aktivni_ispiti = Ispit::dohvatiSveGdje("aktivan", "1");

?>
<html>
<?php require("partials/head.php") ?>
<body>
<?php require("partials/nav.php") ?>
    <table>
        <thead>
            <th>Predmet</th>
            <th>Opis</th>
            <th>Datum ispita</th>
            <th>Kraj prijave</th>
            <th>Aktivan</th>
        </thead>
        <tbody>
        <?php foreach ($aktivni_ispiti as $ispit) : ?>
            <tr>
                <td><?= $ispit->predmet()->naziv ?></td>
                <td><?= $ispit->opis ?></td>
                <td><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                <td><?= $ispit->kraj_prijave()->format("Y-m-d H:i") ?></td>
                <td><?= $ispit->aktivan ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>