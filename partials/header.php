<?php

use Helpers\Auth;
?>
<header>
    <div class="text-center">
        <p class="font-weight-bold" style="font-size: 3rem;">Prijava ispita</p>
        <p class="small">Projektni zadatak iz Web programiranja @ IPIA Tuzla</p>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-0 px-2 mb-3">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="?akcija=pocetna">Početna</a>
            </li>

            <?php if (Auth::korisnikJeAdmin()) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="?akcija=ispit/lista">Ispiti</a>
                </li>
            <?php endif ?>
        </ul>
        <ul class="navbar-nav">
            <?php if (Auth::korisnikJePrijavljen()) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="?akcija=korisnik/promjena_sifre">Promjena šifre</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?akcija=korisnik/odjava">Odjava</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="?akcija=korisnik/registracija">Registracija</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="?akcija=korisnik/prijava">Prijava</a>
                </li>
            <?php endif ?>
        </ul>
    </nav>

    <?php require("partials/notifikacije.php") ?>
</header>
