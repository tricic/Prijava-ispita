<?php

class Funkcije
{
    public static function mysqli(): mysqli
    {
        $mysqli = new mysqli("localhost", "root", "", "webapp_0173-17");
        
        if ($mysqli->connect_errno)
        {
            throw new Exception("Greška u povezivanju baze: " . $mysqli->connect_error);
        }
    
        if ($mysqli->ping() == false)
        {
            throw new Exception("Greška s konekcijom baze: " . $mysqli->error);
        }
    
        return $mysqli;
    }

    public static function mysqliProvjera(\mysqli $mysqli, string $sql = ""): void
    {
        if ($mysqli->errno)
        {
            throw new Exception($mysqli->error . " SQL($sql)");
        }
    }

    public static function korisnikPrijavljen(): bool
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        
        return isset($_SESSION["korisnik_prijavljen"]) && $_SESSION["korisnik_prijavljen"] == true;
    }
}
