<?php

namespace Entiteti;

use Funkcije;
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
}