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

        pdo()->query($sql);
        $this->id = pdo()->lastInsertId();
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

        pdo()->query($sql);
    }

    public function izbrisi(): void
    {
        $tabela = static::imeTabele();
        $polja = get_object_vars($this);
        $sql = "DELETE FROM $tabela WHERE id = {$polja['id']}";
    
        pdo()->query($sql);
    }

    public static function dohvati(string $naziv_kolone = "id", string $id): ?object
    {
        $rez = static::dohvatiSve($naziv_kolone, $id);
        return $rez[0] ?? null;
    }

    public static function dohvatiSve(string $kolona = "", string $vrijednost = ""): array
    {
        $tabela = static::imeTabele();
        
        $sql = "SELECT * FROM $tabela";
        if (empty($kolona) == false)
        {
            $sql .= " WHERE $kolona = '$vrijednost'";
        }

        $stmt = pdo()->query($sql);

        $rezNiz = [];
        while ($obj = $stmt->fetchObject(static::class))
        {
            $rezNiz[] = $obj;
        }
        
        return $rezNiz;
    }

    protected static function imeTabele(): string
    {
        $reflection = new ReflectionClass(static::class);
        return $reflection->getShortName();
    }
}