<?php

use Entiteti\Korisnik;

function mysqli(): mysqli
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

function mysqliProvjera(\mysqli $mysqli, string $sql = ""): void
{
    if ($mysqli->errno)
    {
        throw new Exception($mysqli->error . " SQL($sql)");
    }
}

function korisnikPrijavljen(): bool
{
    return isset($_SESSION["korisnik_prijavljen"]) && $_SESSION["korisnik_prijavljen"] == true;
}

function prijavljeniKorisnik(): ?Korisnik
{
    if (korisnikPrijavljen() == false)
    {
        return null;
    }

    return Korisnik::dohvati("id", $_SESSION["korisnik_id"]);
}

function zonaZaPrijavljene(): void
{
    if (korisnikPrijavljen() == false)
    {
        preusmjeri("korisnik/prijava", ["greska" => "Niste prijavljeni!"]);
    }
}

function zonaZaNeprijavljene(): void
{
    if (korisnikPrijavljen())
    {
        preusmjeri();
    }
}

function zonaZaAdmine(): void
{
    $korisnik = prijavljeniKorisnik();

    if (is_null($korisnik) || $korisnik->rank != "admin")
    {
        preusmjeri("", ["greska" => "Zabranjen pristup!"]);
    }
}

function objekatMoraPostojati(?object $obj, string $akcija = "", string $poruka = "Greška!")
{
    if (is_null($obj))
    {
        preusmjeri($akcija, ["greska" => $poruka]);
    }
}

function preusmjeri(string $akcija = "", array $parametri = [])
{
    if (empty($akcija))
    {
        $akcija = "pocetna";
    }

    $query = http_build_query($parametri);
    header("Location: ?akcija=$akcija&$query");
}