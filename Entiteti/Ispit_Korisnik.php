<?php

namespace Entiteti;
use \Exception;
use \Funkcije;

class Ispit_Korisnik extends Entitet
{
    public $ispit_id;
    public $korisnik_id;

    public function izbrisi(): void
    {
        $tabela = static::imeTabele();
        $sql = "DELETE FROM $tabela WHERE ispit_id = {$this->ispit_id} AND korisnik_id = {$this->korisnik_id}";
    
        $mysqli = Funkcije::dajMysqli();
        $result = $mysqli->query($sql);

        if ($result == false)
        {
            throw new Exception($mysqli->error);
        }

        $mysqli->close();
    }
}