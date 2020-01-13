<?php

namespace Helpers;

use Entiteti\Korisnik;

abstract class Auth
{
    public static function korisnikPrijavljen(): bool
    {
        return isset($_SESSION["korisnik_prijavljen"]) && $_SESSION["korisnik_prijavljen"] == true;
    }

    public static function prijavljeniKorisnik(): ?Korisnik
    {
        return self::korisnikPrijavljen() ? Korisnik::dohvati("id", $_SESSION["korisnik_id"]) : null;
    }

    public static function zonaKorisnik(): void
    {
        if (self::korisnikPrijavljen() == false)
        {
            // TODO
            header("Location: korisnik/prijava.php?greska=Niste prijavljeni!");
        }
    }

    public static function zonaAdmin(): void
    {
        $korisnik = self::prijavljeniKorisnik();
        if (is_null($korisnik) || $korisnik->rank != "admin")
        {
            // TODO
            header("Location: index.php?greska=Pristup zabranjen!");
        }
    }
}