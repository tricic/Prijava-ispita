<?php

namespace Entiteti;

use DateTime;

class Ispit extends Entitet
{
    public $id;
    public $predmet_id;
    public $opis;
    public $datum;
    public $pocetak_prijave;
    public $kraj_prijave;
    public $aktivan;

    public function predmet(): ?Predmet
    {
        return Predmet::dohvati($this->predmet_id);
    }

    public function datum(): ?DateTime
    {
        return empty($this->datum) ? null : new DateTime($this->datum);
    }

    public function kraj_prijave(): ?DateTime
    {
        return empty($this->kraj_prijave) ? null : new DateTime($this->kraj_prijave);
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
        $ispit_korisnik_rez = Ispit_Korisnik::dohvatiSveGdje("ispit_id", $this->id);

        foreach ($ispit_korisnik_rez as $ispit_korisnik)
        {
            $prijavljeni_korisnici[] = $ispit_korisnik->korisnik();
        }

        return $prijavljeni_korisnici;
    }
}
