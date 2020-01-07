<?php
spl_autoload_register();

use Entiteti\Ispit;

Funkcije::zonaZaPrijavljene();

$ispit_id = $_GET["id"] ?? 0;
$korisnik = Funkcije::prijavljeniKorisnik();
$ispit = Ispit::dohvati("id", $ispit_id);

if (is_null($ispit))
{
    header("Location: index.php?greska=Ispit_nije_pronađen!");
}

if (isset($_GET["odjava"]))
{
    $ispit->odjaviKorisnika($korisnik);
    header("Location: index.php?poruka=Ispit_odjavljen.");
}
else
{
    $ispit->prijaviKorisnika($korisnik);
    header("Location: index.php?poruka=Ispit_prijavljen.");
}
