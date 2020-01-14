<?php

use Entiteti\Ispit;
use Helpers\Auth;

Auth::adminZona();

$ispit_id = $_GET["id"] ?? 0;
$ispit = Ispit::dohvati("id", $ispit_id);
objekatMoraPostojati($ispit, "ispit/lista");

$ispit->izbrisi();

preusmjeri("ispit/lista", [
    "poruka" => "Ispit obrisan " . $ispit->predmet()->naziv . " - $ispit->opis."
]);