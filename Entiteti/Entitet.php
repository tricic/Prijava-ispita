<?php

namespace Entiteti;

use \DateTime;
use \Funkcije;
use \ReflectionClass;

abstract class Entitet
{
    public function unesi(): void
    {
        $tabela = static::imeTabele();
        $sql = "INSERT INTO $tabela VALUES(null";

        $polja = get_object_vars($this);
        foreach ($polja as $naziv => $vrijednost)
        {
            if ($naziv == "id")
            {
                continue;
            }
            else if (is_null($vrijednost))
            {
                $sql .= ", null";
                continue;
            }                
            else if ($vrijednost instanceof DateTime)
            {
                $vrijednost = $vrijednost->format("Y-m-d H:i:s");
            }

            $sql .= ", '$vrijednost'";
        }

        $sql .= ")";

        $mysqli = Funkcije::mysqli();
        $result = $mysqli->query($sql);
        Funkcije::mysqliProvjera($mysqli, $sql);
        $mysqli->close();
    }

    public function azuriraj(): void
    {
        $tabela = static::imeTabele();
        $sql = "UPDATE $tabela SET";

        $flag = false;
        $polja = get_object_vars($this);
        foreach ($polja as $naziv => $vrijednost)
        {
            if (empty($vrijednost) == false && $naziv != "id")
            {
                if ($flag == false)
                {
                    $sql .= " $naziv = '$vrijednost'";
                    $flag = true;
                }
                else
                {
                    $sql .= ", $naziv = '$vrijednost'";
                }
            }
        }

        $sql .= " WHERE id = {$polja['id']}";

        $mysqli = Funkcije::mysqli();
        $result = $mysqli->query($sql);
        Funkcije::mysqliProvjera($mysqli, $sql);
        $mysqli->close();
    }

    public function izbrisi(): void
    {
        $tabela = static::imeTabele();
        $polja = get_object_vars($this);
        $sql = "DELETE FROM $tabela WHERE id = {$polja['id']}";
    
        $mysqli = Funkcije::mysqli();
        $result = $mysqli->query($sql);
        Funkcije::mysqliProvjera($mysqli, $sql);
        $mysqli->close();
    }

    public static function dohvati(string $id, string $naziv_kolone = "id"): ?object
    {
        $rez = static::dohvatiSveGdje($naziv_kolone, $id);
        return $rez[0] ?? null;
    }

    public static function dohvatiSve(): array
    {
        return static::dohvatiSveGdje("1", "1");
    }

    public static function dohvatiSveGdje(string $kolona, string $vrijednost): array
    {
        $mysqli = Funkcije::mysqli();
        $tabela = static::imeTabele();
        $sql = "SELECT * FROM $tabela WHERE $kolona = '$vrijednost'";
        $result = $mysqli->query($sql);
        Funkcije::mysqliProvjera($mysqli, $sql);
        $mysqli->close();

        $rezNiz = [];
        while ($obj = $result->fetch_object(static::class))
        {
            $rezNiz[] = $obj;
        }
        
        $result->close();
        return $rezNiz;
    }

    protected static function imeTabele(): string
    {
        $reflection = new ReflectionClass(static::class);
        return $reflection->getShortName();
    }
}