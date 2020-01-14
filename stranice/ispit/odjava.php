<?php

use Entiteti\Ispit;
use Entiteti\Korisnik;
use Helpers\Auth;

Auth::korisnikZona();

$ispit_id = $_GET["id"] ?? 0;
$korisnik_id = $_GET["kid"] ?? 0;
$odjavi_sve = isset($_GET["odjavi_sve"]);

$ispit = Ispit::dohvati("id", $ispit_id);
objekatMoraPostojati($ispit);

if ($korisnik_id) // Odjava korisnika od strane admina
{
    Auth::adminZona();

    $korisnik = Korisnik::dohvati("id", $korisnik_id);
    objekatMoraPostojati($korisnik);
    $ispit->odjaviKorisnika($korisnik);

    preusmjeri("ispit/izmjena", [
        "id" => $ispit->id,
        "poruka" => "Korisnik $korisnik->ime $korisnik->prezime je odjavljen sa ispita."
    ]);
}
else if ($odjavi_sve) // Odjava svih korisnika od strane admina
{
    Auth::adminZona();

    $ispit->odjaviSveKorisnike();

    preusmjeri("ispit/izmjena", [
        "id" => $ispit->id,
        "poruka" => "Svi korisnici su odjavljeni a ispita."
    ]);
}
else // Odjava prijavljenog korisnika
{
    $korisnik = Auth::prijavljeniKorisnik();
    $ispit->odjaviKorisnika($korisnik);
    
    $naziv_predmeta = $ispit->predmet()->naziv;
    preusmjeri("", [
        "poruka" => "Odjavljeni ste sa ispita $naziv_predmeta - $ispit->opis."
    ]);
}