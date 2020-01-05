<?php

spl_autoload_register();
session_start();

use Entiteti\Korisnik;

Korisnik::odjava();
header("Location: /index.php");
