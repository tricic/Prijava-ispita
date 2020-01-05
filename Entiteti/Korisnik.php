<?php

namespace Entiteti;

use GreskeException;

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

    public function prijavljeniIspiti(): array
    {
        $prijavljeni_ispiti = [];
        $ispit_korisnik_rez = Ispit_Korisnik::dohvatiSveGdje("korisnik_id", $this->id);

        foreach ($ispit_korisnik_rez as $ispit_korisnik)
        {
            $prijavljeni_ispiti[] = $ispit_korisnik->ispit();
        }

        return $prijavljeni_ispiti;
    }

    public static function prijava(string $korisnicko_ime, string $sifra): ?Korisnik
    {
        $korisnik = Korisnik::dohvati($korisnicko_ime, "korisnicko_ime");

        if (is_null($korisnik))
        {
            throw new GreskeException(["Korisnik ne postoji!"]);
        }

        if (password_verify($sifra, $korisnik->sifra) == false)
        {
            throw new GreskeException(["Pogrešna šifra!"]);
        }

        if ($korisnik)
        {
            $_SESSION["korisnik_prijavljen"] = true;
            $_SESSION["korisnik_id"] = (int)$korisnik->id;
        }

        return $korisnik;
    }

    public static function odjava(): void
    {
        session_destroy();
    }
}