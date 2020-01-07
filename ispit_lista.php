<?php
spl_autoload_register();

use Entiteti\Ispit;

Funkcije::zonaZaAdmine();
$ispiti = Ispit::dohvatiSve();
?>
<html>
    <?php require("partials/head.php") ?>

    <body>
        <?php require("partials/header.php") ?>

        <a href="ispit_novi.php" class="btn green">Novi ispit</a>

        <table style="margin-top: 20px;">
            <thead>
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
                    <tr>
                        <td><?= $ispit->predmet()->naziv ?></td>
                        <td><?= $ispit->opis ?></td>
                        <td><?= $ispit->rok_prijave()->format("Y-m-d H:i") ?></td>
                        <td><?= $ispit->datum()->format("Y-m-d H:i") ?></td>
                        <td><?= $ispit->aktivan ?></td>
                        <td><?= count($ispit->prijavljeniKorisnici()) ?>
                        <td>
                            <a href="ispit_uredi.php?id=<?= $ispit->id ?>" class="btn btn-small blue">Vidi / Uredi</a>
                            <a href="ispit_izbrisi.php?id=<?= $ispit->id ?>" class="btn btn-small red">Izbriši</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?php require("partials/footer.php") ?>
    </body>
</html>