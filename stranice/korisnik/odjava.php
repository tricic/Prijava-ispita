<?php

session_destroy();

$poruka = $_GET["poruka"] ?? "Doviđenja!";
preusmjeri("korisnik/prijava", ["poruka" => $poruka]);