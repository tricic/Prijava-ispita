<?php

namespace Entiteti;

use \Exception;
use \Funkcije;

class Ispit extends Entitet
{
    public $id;
    public $predmet_id;
    public $opis;
    public $datum;
    public $pocetak_prijave;
    public $kraj_prijave;
    public $aktivan;

    public function prijaviKorisnika(Korisnik $korisnik): void
    {
        $ispit_korisnik = new Ispit_Korisnik();
        $ispit_korisnik->ispit_id = $this->id;
        $ispit_korisnik->korisnik_id = $korisnik->id;
        $ispit_korisnik->Unesi();
    }

    public function odjaviKorisnika(Korisnik $korisnik): void
    {
        $ispit_korisnik = new Ispit_Korisnik();
        $ispit_korisnik->ispit_id = $this->id;
        $ispit_korisnik->korisnik_id = $korisnik->id;
        $ispit_korisnik->Izbrisi();
    }

    public function dohvatiPrijavljeneKorisnike(): array
    {
        $mysqli = Funkcije::dajMysqli();

        // Dohvati listu id-eva korisnika
        $result = $mysqli->query("SELECT korisnik_id FROM ispit_korisnik WHERE ispit_id = {$this->id}");

        if ($result == false) {
            throw new Exception($mysqli->error);
        }

        $idevi = [];
        while ($row = $result->fetch_assoc()) {
            $idevi[] = $row["korisnik_id"];
        }

        // Konvertuj id-eve u instance Korisnika
        $prijavljeniKorisnici = [];
        foreach ($idevi as $id) {
            $prijavljeniKorisnici[] = Korisnik::Dohvati($id);
        }

        $result->close();
        $mysqli->close();
        return $prijavljeniKorisnici;
    }
}
