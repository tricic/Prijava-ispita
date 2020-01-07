<?php
spl_autoload_register();

use Entiteti\Ispit;
use Entiteti\Korisnik;

Funkcije::zonaZaPrijavljene();

$ispit_id = $_GET["id"] ?? 0;
$korisnik_id = $_GET["kid"] ?? null;
$odjava = isset($_GET["odjava"]);

$ispit = Ispit::dohvati("id", $ispit_id);
Funkcije::objekatMoraPostojati($ispit);

if (is_null($korisnik_id)) // Prijava/odjava prijavljenog korisnika
{
    $korisnik = Funkcije::prijavljeniKorisnik();

    $odjava ? $ispit->odjaviKorisnika($korisnik) : $ispit->prijaviKorisnika($korisnik);
    $naziv_predmeta = $ispit->predmet()->naziv;

    if ($odjava)
    {
        $poruka = "Odjavljeni ste sa ispita $naziv_predmeta - {$ispit->opis}.";
        header("Location: index.php?poruka=$poruka");
    }
    else
    {
        $poruka = "Prijavljeni ste na ispit $naziv_predmeta - $ispit->opis. Sretno!";
        header("Location: index.php?poruka=$poruka");
    }
}
else if($odjava && $korisnik_id != "svi") // Odjava korisnika od strane admina
{
    Funkcije::zonaZaAdmine();

    $korisnik = Korisnik::dohvati("id", $korisnik_id);
    Funkcije::objekatMoraPostojati($korisnik, "ispit_uredi.php?id=$ispit_id");
    $ispit->odjaviKorisnika($korisnik);

    $poruka = "Korisnik $korisnik->ime $korisnik->prezime je odjavljen sa ispita.";
    header("Location: ispit_uredi.php?id=$ispit_id&poruka=$poruka");
}
else if ($odjava && $korisnik_id == "svi") // Odjava svih korisnika od strane admina
{
    Funkcije::zonaZaAdmine();
    $ispit->odjaviSveKorisnike();

    $poruka = "Svi korisnici su odjavljeni a ispita.";
    header("Location: ispit_uredi.php?id=$ispit_id&poruka=$poruka");
}
