<?php

class Funkcije
{
    public static function dajMysqli(): mysqli
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
}
