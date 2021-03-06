<?php

namespace Entiteti;

use DateTime;

class Ispit extends Entitet
{
    public $id;
    public $predmet_id;
    public $opis;
    public $datum;
    public $rok_prijave;
    public $max_korisnika;
    public $max_bodova;
    public $aktivan;

    public function predmet(): ?Predmet
    {
        return Predmet::dohvati("id", $this->predmet_id);
    }

    public function datum(): ?DateTime
    {
        return empty($this->datum) ? null : new DateTime($this->datum);
    }

    public function rok_prijave(): ?DateTime
    {
        return empty($this->rok_prijave) ? null : new DateTime($this->rok_prijave);
    }

    public function datumIstekao(): bool
    {
        return new DateTime > $this->datum(); 
    }

    public function rokPrijaveIstekao(): bool
    {
        return new DateTime > $this->rok_prijave(); 
    }

    public function izbrisi(): void
    {
        $this->odjaviSveKorisnike();
        parent::izbrisi();
    }

    public function validacijaZaPrijavu(Korisnik $korisnik):  array
    {
        $greske = [];
        $broj_prijavljenih = count($this->prijavljeniKorisnici());

        if ($broj_prijavljenih >= $this->max_korisnika)
        {
            $greske[] = "Dostignut maksimalan broj mogućih prijava.";
        }

        if (in_array($this, $korisnik->prijavljeniIspiti()))
        {
            $greske[] = "Već ste prijavljeni na ispit.";
        }

        if ($this->rokPrijaveIstekao())
        {
            $greske[] = "Rok prijave je istekao.";
        }

        return $greske;
    }

    public function prijaviKorisnika(Korisnik $korisnik): void
    {
        $ispit_korisnik = new Ispit_Korisnik();
        $ispit_korisnik->ispit_id = $this->id;
        $ispit_korisnik->korisnik_id = $korisnik->id;
        $ispit_korisnik->unesi();
    }

    public function odjaviKorisnika(Korisnik $korisnik): void
    {
        $ispit_korisnik = new Ispit_Korisnik();
        $ispit_korisnik->ispit_id = $this->id;
        $ispit_korisnik->korisnik_id = $korisnik->id;
        $ispit_korisnik->Izbrisi();
    }

    public function prijavljeniKorisnici(): array
    {
        $prijavljeni_korisnici = [];
        $ispit_korisnik_rez = Ispit_Korisnik::dohvatiSve("ispit_id", $this->id);

        foreach ($ispit_korisnik_rez as $ispit_korisnik)
        {
            $prijavljeni_korisnici[] = $ispit_korisnik->korisnik();
        }

        return $prijavljeni_korisnici;
    }

    public function odjaviSveKorisnike(): void
    {
        $prijavljeni_korisnici = $this->prijavljeniKorisnici();
        foreach ($prijavljeni_korisnici as $korisnik)
        {
            $this->odjaviKorisnika($korisnik);
        }
    }
}
