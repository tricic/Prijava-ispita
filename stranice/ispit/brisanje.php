<?php

use Entiteti\Ispit;
use Helpers\Auth;

Auth::adminZona();

$ispit = Ispit::dohvati("id", $_GET["id"] ?? 0);

objekatMoraPostojati($ispit, "Ispit nije pronađen.");

$ispit->izbrisi();

nova_poruka("Ispit obrisan " . $ispit->predmet()->naziv . " - $ispit->opis.");
preusmjeri("ispit/lista");