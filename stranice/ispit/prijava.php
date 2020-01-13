<?php

use Entiteti\Ispit;
use Entiteti\Korisnik;

zonaZaPrijavljene();

$ispit_id = $_GET["id"] ?? 0;
$korisnik_id = $_GET["kid"] ?? null;
$odjava = isset($_GET["odjava"]);

$ispit = Ispit::dohvati("id", $ispit_id);
objekatMoraPostojati($ispit);

if (is_null($korisnik_id)) // Prijava/odjava prijavljenog korisnika
{
    $korisnik = prijavljeniKorisnik();

    $odjava ? $ispit->odjaviKorisnika($korisnik) : $ispit->prijaviKorisnika($korisnik);
    $naziv_predmeta = $ispit->predmet()->naziv;

    if ($odjava)
    {
        preusmjeri("", [
            "poruka" => "Odjavljeni ste sa ispita $naziv_predmeta - $ispit->opis."
        ]);
    }
    else
    {
        preusmjeri("", [
            "poruka" => "Prijavljeni ste na ispit $naziv_predmeta - $ispit->opis. Sretno!"
        ]);
    }
}
else if($odjava && $korisnik_id != "svi") // Odjava korisnika od strane admina
{
    zonaZaAdmine();

    $korisnik = Korisnik::dohvati("id", $korisnik_id);
    objekatMoraPostojati($korisnik);
    $ispit->odjaviKorisnika($korisnik);

    preusmjeri("ispit/izmjena", [
        "id" => $ispit->id,
        "poruka" => "Korisnik $korisnik->ime $korisnik->prezime je odjavljen sa ispita."
    ]);
}
else if ($odjava && $korisnik_id == "svi") // Odjava svih korisnika od strane admina
{
    zonaZaAdmine();
    $ispit->odjaviSveKorisnike();

    preusmjeri("ispit/izmjena", [
        "id" => $ispit->id,
        "poruka" => "Svi korisnici su odjavljeni a ispita."
    ]);
}
