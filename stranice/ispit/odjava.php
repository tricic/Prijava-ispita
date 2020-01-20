<?php

use Entiteti\Ispit;
use Entiteti\Korisnik;
use Helpers\Auth;

Auth::korisnikZona();

$ispit_id = $_GET["id"] ?? 0;
$korisnik_id = $_GET["kid"] ?? 0;
$odjavi_sve = isset($_GET["odjavi_sve"]);
$ispit = Ispit::dohvati("id", $ispit_id);

objekatMoraPostojati($ispit, "Ispit nije pronađen.");

if ($korisnik_id) // Odjava korisnika od strane admina
{
    Auth::adminZona();

    $korisnik = Korisnik::dohvati("id", $korisnik_id);
    
    objekatMoraPostojati($korisnik, "Korisnik nije pronađen.");
    
    $ispit->odjaviKorisnika($korisnik);

    nova_poruka("Korisnik $korisnik->ime $korisnik->prezime je odjavljen sa ispita.");
    preusmjeri("ispit/izmjena", ["id" => $ispit->id]);
}
else if ($odjavi_sve) // Odjava svih korisnika od strane admina
{
    Auth::adminZona();

    $ispit->odjaviSveKorisnike();

    nova_poruka("Svi korisnici su odjavljeni a ispita.");
    preusmjeri("ispit/izmjena", ["id" => $ispit->id]);
}
else // Odjava prijavljenog korisnika
{
    $korisnik = Auth::prijavljeniKorisnik();
    $ispit->odjaviKorisnika($korisnik);
    
    $naziv_predmeta = $ispit->predmet()->naziv;
    nova_poruka("Odjavljeni ste sa ispita $naziv_predmeta - $ispit->opis.");
    preusmjeri("");
}