<?php

spl_autoload_register();
session_start();
date_default_timezone_set("Europe/Sarajevo");
require("funkcije.php");

$akcija = !empty($_GET["akcija"]) ? $_GET["akcija"] : "pocetna";
$fajl = "stranice/" . $akcija . ".php";

?>
<html>
    <?php require("partials/head.php") ?>
    
    <body>
        <?php
            require("partials/header.php");
            
            if (file_exists($fajl))
            {
                include($fajl);
            }
            else
            {
                ?>
                    <div style="text-align: center;">
                        <h1>Greška!</h2>
                        <p style="font-size: 2em;">Stranica ne postoji!</p>
                    </div>
                <?php
            }

            require("partials/footer.php");
        ?>
    </body>
</html>