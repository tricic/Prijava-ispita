<?php

use Entiteti\Korisnik;

class Funkcije
{
    public static function mysqli(): mysqli
    {
        $mysqli = new mysqli("localhost", "root", "", "webapp_0173-17");
        
        if ($mysqli->connect_errno)
        {
            throw new Exception("Greška u povezivanju baze: " . $mysqli->connect_error);
        }
    
        if ($mysqli->ping() == false)
        {
            throw new Exception("Greška s konekcijom baze: " . $mysqli->error);
        }
    
        $mysqli->set_charset("utf8");
        return $mysqli;
    }

    public static function mysqliProvjera(\mysqli $mysqli, string $sql = ""): void
    {
        if ($mysqli->errno)
        {
            throw new Exception($mysqli->error . " SQL($sql)");
        }
    }

    public static function startajSesiju(): void
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public static function korisnikPrijavljen(): bool
    {
        Funkcije::startajSesiju();
        return isset($_SESSION["korisnik_prijavljen"]) && $_SESSION["korisnik_prijavljen"] == true;
    }

    public static function prijavljeniKorisnik(): ?Korisnik
    {
        if (self::korisnikPrijavljen() == false)
        {
            return null;
        }

        return Korisnik::dohvati("id", $_SESSION["korisnik_id"]);
    }

    public static function zonaZaPrijavljene(): void
    {
        if (self::korisnikPrijavljen() == false)
        {
            header("Location: korisnik_prijava.php?greska=Niste prijavljeni!");
        }
    }

    public static function zonaZaNeprijavljene(): void
    {
        if (self::korisnikPrijavljen())
        {
            header("Location: index.php");
        }
    }

    public static function zonaZaAdmine(): void
    {
        $korisnik = self::prijavljeniKorisnik();

        if (is_null($korisnik) || $korisnik->rank != "admin")
        {
            header("Location: index.php?greska=Pristup zabranjen!");
        }
    }

    public static function objekatMoraPostojati(?object $obj, string $preusmjeri = "index.php", string $poruka = "Greška!")
    {
        if (is_null($obj))
        {
            header("Location: $preusmjeri?greska=$poruka");
        }
    }
}
