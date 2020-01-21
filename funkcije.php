<?php

function pdo(): PDO
{
    static $pdo;

    if (is_null($pdo))
    {
        $dsn = "sqlite:database.sqlite";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $pdo = new PDO($dsn, null, null, $options);
    }
    
    return $pdo;
}

function objekatMoraPostojati(?object $obj, string $poruka = "Objekat ne postoji."): void
{
    if (is_null($obj))
    {
        throw new RuntimeException($poruka);
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