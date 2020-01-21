<?php

namespace Entiteti;

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
        $ispit_korisnik_rez = Ispit_Korisnik::dohvatiSve("korisnik_id", $this->id);

        foreach ($ispit_korisnik_rez as $ispit_korisnik)
        {
            $prijavljeni_ispiti[] = $ispit_korisnik->ispit();
        }

        return $prijavljeni_ispiti;
    }

    public function validacijaZaUnos(): array
    {
        $greske = [];

        foreach (get_object_vars($this) as $prop => $val)
        {
            if (empty($val) && $prop != "id")
            {
                $greske[] = "Polje $prop je prazno.";
            }
        }

        if (self::dohvati("korisnicko_ime", $this->korisnicko_ime))
        {
            $greske[] = "Korisničko ime je zauzeto.";
        }

        if (self::dohvati("email", $this->email))
        {
            $greske[] = "Email adresa je povezana sa drugim računom.";
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) == false)
        {
            $greske[] = "Email adresa nije validna.";
        }

        return $greske;
    }
}