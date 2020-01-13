<?php

namespace Entiteti;
use \Funkcije;

class Ispit_Korisnik extends Entitet
{
    public $ispit_id;
    public $korisnik_id;

    public function ispit(): ?Ispit
    {
        return Ispit::dohvati("id", $this->ispit_id);
    }

    public function korisnik(): ?Korisnik
    {
        return Korisnik::dohvati("id", $this->korisnik_id);
    }

    public function izbrisi(): void
    {
        $tabela = static::imeTabele();
        $sql = "DELETE FROM $tabela WHERE ispit_id = {$this->ispit_id} AND korisnik_id = {$this->korisnik_id}";
    
        $mysqli = mysqli();
        $result = $mysqli->query($sql);
        mysqliProvjera($mysqli, $sql);
        $mysqli->close();
    }
}