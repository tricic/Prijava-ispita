<?php
spl_autoload_register();

Funkcije::startajSesiju();
session_destroy();

header("Location: /index.php");
