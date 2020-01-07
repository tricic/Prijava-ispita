<?php
spl_autoload_register();

use Entiteti\Ispit;

Funkcije::zonaZaAdmine();

$ispit_id = $_GET["id"] ?? 0;
$ispit = Ispit::dohvati("id", $ispit_id);

if (is_null($ispit))
{
    header("Location: ispit_lista.php?greska=Ispit_nije_pronađen!");
}

$ispit->izbrisi();
header("Location: ispit_lista.php?poruka=Ispit_obrisan.");
