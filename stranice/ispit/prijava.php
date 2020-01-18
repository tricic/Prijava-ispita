<?php

use Entiteti\Ispit;
use Helpers\Auth;

Auth::korisnikZona();

$ispit = Ispit::dohvati("id", $_GET["id"] ?? 0);

objekatMoraPostojati($ispit, "Ispit nije pronađen.");

$korisnik = Auth::prijavljeniKorisnik();
$greske = $ispit->validacijaZaPrijavu($korisnik);

if ($greske)
{
    // FIXME
    preusmjeri("", [
        "greska" => $greske[0]
    ]);
}

$ispit->prijaviKorisnika($korisnik);

$naziv_predmeta = $ispit->predmet()->naziv;
preusmjeri("", [
    "poruka" => "Prijavljeni ste na ispit $naziv_predmeta - $ispit->opis. Sretno!"
]);