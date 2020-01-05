<?php

namespace Entiteti;
use \Funkcije;

class Ispit_Korisnik extends Entitet
{
    public $ispit_id;
    public $korisnik_id;

    public function ispit(): ?Ispit
    {
        return Ispit::dohvati($this->ispit_id);
    }

    public function korisnik(): ?Korisnik
    {
        return Korisnik::dohvati($this->korisnik_id);
    }

    public function izbrisi(): void
    {
        $tabela = static::imeTabele();
        $sql = "DELETE FROM $tabela WHERE ispit_id = {$this->ispit_id} AND korisnik_id = {$this->korisnik_id}";
    
        $mysqli = Funkcije::mysqli();
        $result = $mysqli->query($sql);
        Funkcije::mysqliProvjera($mysqli, $sql);
        $mysqli->close();
    }
}