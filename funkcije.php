<?php

function mysqli(): mysqli
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

    $mysqli->set_charset("utf8");
    return $mysqli;
}

function mysqliProvjera(\mysqli $mysqli, string $sql = ""): void
{
    if ($mysqli->errno)
    {
        throw new Exception($mysqli->error . " SQL($sql)");
    }
}

function objekatMoraPostojati(?object $obj, string $akcija = "", string $poruka = "Greška!"): void
{
    if (is_null($obj))
    {
        preusmjeri($akcija, ["greska" => $poruka]);
    }
}

function preusmjeri(string $akcija = "", array $parametri = []): void
{
    if (empty($akcija))
    {
        $akcija = "pocetna";
    }

    $query = http_build_query($parametri);
    header("Location: ?akcija=$akcija&$query");
    exit;
}