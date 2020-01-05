<?php

namespace Entiteti;

use Funkcije;

class Korisnik extends Entitet 
{
    public $id;
    public $korisnicko_ime;
    public $ime;
    public $prezime;
    public $email;
    public $rank = "student";
    public $sifra;

    public function sifra(string $raw_sifra): string
    {
        $this->sifra = password_hash($raw_sifra, PASSWORD_DEFAULT);
        return $this->sifra;
    }

    public static function prijava(string $korisnicko_ime, string $sifra): ?Korisnik
    {
        $sifra = password_hash($sifra, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM korisnik WHERE korisnicko_ime = '$korisnicko_ime' AND sifra = '$sifra'";
        $mysqli = Funkcije::dajMysqli();
        $result = $mysqli->query($sql);

        if ($result == false)
        {
            throw new \Exception($mysqli->error);
        }

        $korisnik = $result->fetch_object(static::class);
        $mysqli->close();
        return $korisnik;
    }
}