<?php
spl_autoload_register();

use Entiteti\Ispit;

Funkcije::zonaZaAdmine();

$ispit_id = $_GET["id"] ?? 0;
$ispit = Ispit::dohvati("id", $ispit_id);
Funkcije::objekatMoraPostojati($ispit, "ispit_lista.php");
$ispit->izbrisi();
$predmet_naziv = $ispit->predmet()->naziv;
$poruka = "Ispit obrisan $predmet_naziv - $ispit->opis";
header("Location: ispit_lista.php?poruka=$poruka");
