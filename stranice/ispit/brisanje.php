<?php

use Entiteti\Ispit;

zonaZaAdmine();

$ispit_id = $_GET["id"] ?? 0;
$ispit = Ispit::dohvati("id", $ispit_id);
objekatMoraPostojati($ispit, "ispit/lista");
$ispit->izbrisi();
$predmet_naziv = $ispit->predmet()->naziv;
$poruka = "Ispit obrisan $predmet_naziv - $ispit->opis";
header("Location: ispit/lista.php?poruka=$poruka");
