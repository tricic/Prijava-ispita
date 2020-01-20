<?php

spl_autoload_register();
session_start();
date_default_timezone_set("Europe/Sarajevo");
require("funkcije.php");

$akcija = !empty($_GET["akcija"]) ? $_GET["akcija"] : "pocetna";
$fajl = "stranice/" . $akcija . ".php";

// Napravi prenesene varijable
foreach ($_SESSION["prenesene_varijable"] ?? [] as $key => $value)
{
    $$key = $value;
}
unset($_SESSION["prenesene_varijable"]);

?>
<html>
    <?php require("partials/head.php") ?>
    
    <body>
        <?php
            require("partials/header.php");
            
            if (file_exists($fajl))
            {
                try
                {
                    include($fajl);
                }
                catch (Exception $e)
                {
                    $greska = $e->getMessage();
                    require("partials/greska.php");
                }
            }
            else
            {
                $greska = "Stranica ne postoji!";
                require("partials/greska.php");
            }

            require("partials/footer.php");
        ?>
    </body>
</html>