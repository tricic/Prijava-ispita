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
    nova_greska($greske);
    preusmjeri("");
}

$ispit->prijaviKorisnika($korisnik);

$naziv_predmeta = $ispit->predmet()->naziv;
nova_poruka("Prijavljeni ste na ispit $naziv_predmeta - $ispit->opis. Sretno!");
preusmjeri("");