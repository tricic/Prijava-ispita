<?php

namespace Entiteti;

use \DateTime;
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
            }                
            else if ($vrijednost instanceof DateTime)
            {
                $vrijednost = $vrijednost->format("Y-m-d H:i:s");
                $sql .= ", '$vrijednost'";
            }
            else
            {
                $sql .= ", '$vrijednost'";
            }
        }

        $sql .= ")";

        $mysqli = mysqli();
        $mysqli->query($sql);
        mysqliProvjera($mysqli, $sql);
        $this->id = $mysqli->insert_id;
        $mysqli->close();
    }

    public function azuriraj(): void
    {
        $tabela = static::imeTabele();
        $sql = "UPDATE $tabela SET ";

        $polja = get_object_vars($this);
        foreach ($polja as $naziv => $vrijednost)
        {
            if ($naziv == "id")
            {
                continue;
            }
            else if (is_null($vrijednost))
            {
                $sql .= "$naziv = NULL,";
            }                
            else if ($vrijednost instanceof DateTime)
            {
                $vrijednost = $vrijednost->format("Y-m-d H:i:s");
                $sql .= "$naziv = '$vrijednost',";
            }
            else
            {
                $sql .= "$naziv = '$vrijednost',";
            }
        }

        $sql = substr($sql, 0, -1); // Izbacuje zarez sa kraja
        $sql .= " WHERE id = {$polja['id']}";

        $mysqli = mysqli();
        $mysqli->query($sql);
        mysqliProvjera($mysqli, $sql);
        $mysqli->close();
    }

    public function izbrisi(): void
    {
        $tabela = static::imeTabele();
        $polja = get_object_vars($this);
        $sql = "DELETE FROM $tabela WHERE id = {$polja['id']}";
    
        $mysqli = mysqli();
        $mysqli->query($sql);
        mysqliProvjera($mysqli, $sql);
        $mysqli->close();
    }

    public static function dohvati(string $naziv_kolone = "id", string $id): ?object
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
        $mysqli = mysqli();
        $tabela = static::imeTabele();
        $sql = "SELECT * FROM $tabela WHERE $kolona = '$vrijednost'";
        $result = $mysqli->query($sql);
        mysqliProvjera($mysqli, $sql);
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