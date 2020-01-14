<?php

use Entiteti\Ispit;

zonaZaPrijavljene();

$ispit_id = $_GET["id"] ?? 0;
$ispit = Ispit::dohvati("id", $ispit_id);
objekatMoraPostojati($ispit);

if ($ispit->rokPrijaveIstekao())
{
    preusmjeri("", [
        "greska" => "Nedozvoljena prijava na ispit - rok prijave istekao."
    ]);
}

$korisnik = prijavljeniKorisnik();
$ispit->prijaviKorisnika($korisnik);

$naziv_predmeta = $ispit->predmet()->naziv;
preusmjeri("", [
    "poruka" => "Prijavljeni ste na ispit $naziv_predmeta - $ispit->opis. Sretno!"
]);