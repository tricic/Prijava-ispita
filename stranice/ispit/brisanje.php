<?php

use Entiteti\Ispit;
use Helpers\Auth;

Auth::adminZona();

$ispit = Ispit::dohvati("id", $_GET["id"] ?? 0);

objekatMoraPostojati($ispit, "Ispit nije pronađen.");

$ispit->izbrisi();

preusmjeri("ispit/lista", [
    "poruka" => "Ispit obrisan " . $ispit->predmet()->naziv . " - $ispit->opis."
]);