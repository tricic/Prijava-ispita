<?php

// Namespace autoloading
spl_autoload_register();

// Startanje sesije
session_start();

// Postavljanje vremenske zone
date_default_timezone_set("Europe/Sarajevo");

// Učitavanje globalnih funkcija
require("funkcije.php");

// Učitavanje akcije i relativne putanje do skripte
$akcija = !empty($_GET["akcija"]) ? $_GET["akcija"] : "pocetna";
$fajl = "stranice/" . $akcija . ".php";

// Kreiranje prenesenih varijabli
foreach ($_SESSION["prenesene_varijable"] ?? [] as $key => $value)
{
    $$key = $value;
}
unset($_SESSION["prenesene_varijable"]);

echo "<!DOCTYPE html><html lang='bs'>";

require("partials/head.php");

echo "<body class='container'>";

require("partials/header.php");

echo "<main>";

try
{
    if (file_exists($fajl) == false)
    {
        throw new Exception("Stranica ne postoji!");
    }

    include($fajl);
}
catch (Exception $e)
{
    $greska = $e->getMessage();
    require("partials/greska.php");
}

echo "</main>";

require("partials/footer.php");

echo "</body>";

echo "</html>";