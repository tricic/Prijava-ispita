<?php

function mysqli(): mysqli
{
    $mysqli = new mysqli("localhost", "root", "", "prijava_ispita");
    
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

function objekatMoraPostojati(?object $obj, string $poruka = "Objekat ne postoji."): void
{
    if (is_null($obj))
    {
        throw new Exception($poruka);
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

function prenesi_varijablu(string $naziv, $var): void
{
    $_SESSION["prenesene_varijable"][$naziv] = $var;
}

function nova_poruka($poruka): void
{
    if (is_string($poruka))
    {
        $_SESSION["prenesene_varijable"]["poruke"][] = $poruka;
    }
    else if (is_array($poruka))
    {
        foreach ($poruka as $p)
        {
            $_SESSION["prenesene_varijable"]["poruke"][] = strval($p);
        }
    }
    else
    {
        throw new InvalidArgumentException("Očekivan string ili niz stringova.");
    }
}

function nova_greska($greska): void
{
    if (is_string($greska))
    {
        $_SESSION["prenesene_varijable"]["greske"][] = $greska;
    }
    else if (is_array($greska))
    {
        foreach ($greska as $g)
        {
            $_SESSION["prenesene_varijable"]["greske"][] = strval($g);
        }
    }
    else
    {
        throw new InvalidArgumentException("Očekivan string ili niz stringova.");
    }
}