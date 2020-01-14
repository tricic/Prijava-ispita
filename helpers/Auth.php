<?php

namespace Helpers;

use Entiteti\Korisnik;

abstract class Auth
{
    public static function prijavljeniKorisnik(): ?Korisnik
    {
        return self::korisnikJePrijavljen() ? Korisnik::dohvati("id", $_SESSION["korisnik_id"]) : null;
    }

    public static function korisnikJePrijavljen(): bool
    {
        return isset($_SESSION["korisnik_prijavljen"]) && $_SESSION["korisnik_prijavljen"] == true;
    }

    public static function korisnikJeAdmin(): bool
    {
        return self::korisnikJePrijavljen() && self::prijavljeniKorisnik()->rank == "admin";
    }

    public static function korisnikZona(string $preusmjeriAkcija = "korisnik/prijava"): void
    {
        if (self::korisnikJePrijavljen() == false)
        {
            preusmjeri($preusmjeriAkcija, ["greska" => "Potrebno je da se prijavite."]);
        }
    }

    public static function adminZona(string $preusmjeriAkcija = ""): void
    {
        if (self::korisnikJeAdmin() == false)
        {
            preusmjeri($preusmjeriAkcija, ["greska" => "Pristup zabranjen!"]);
        }
    }
}