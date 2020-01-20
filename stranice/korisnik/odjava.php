<?php

session_unset();

$poruka = $_GET["poruka"] ?? "Doviđenja!";
nova_poruka($poruka);
preusmjeri("korisnik/prijava");