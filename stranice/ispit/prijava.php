<?php

use Entiteti\Ispit;
use Helpers\Auth;

Auth::korisnikZona();

$ispit = Ispit::dohvati("id", $_GET["id"] ?? 0);

objekatMoraPostojati($ispit, "Ispit nije pronađen.");

if ($ispit->rokPrijaveIstekao())
{
    preusmjeri("", [
        "greska" => "Nedozvoljena prijava na ispit - rok prijave istekao."
    ]);
}

$korisnik = Auth::prijavljeniKorisnik();
$ispit->prijaviKorisnika($korisnik);

$naziv_predmeta = $ispit->predmet()->naziv;
preusmjeri("", [
    "poruka" => "Prijavljeni ste na ispit $naziv_predmeta - $ispit->opis. Sretno!"
]);