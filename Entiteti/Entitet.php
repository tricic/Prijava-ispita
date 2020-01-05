<?php

namespace Entiteti;

use \DateTime;
use \Exception;
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

        $mysqli = Funkcije::dajMysqli();
        $result = $mysqli->query($sql);

        if ($result == false)
        {
            throw new Exception($mysqli->error);
        }

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

        $mysqli = Funkcije::dajMysqli();
        $result = $mysqli->query($sql);

        if ($result == false)
        {
            throw new Exception($mysqli->error);
        }

        $mysqli->close();
    }

    public function izbrisi(): void
    {
        $tabela = static::imeTabele();
        $polja = get_object_vars($this);
        $sql = "DELETE FROM $tabela WHERE id = {$polja['id']}";
    
        $mysqli = Funkcije::dajMysqli();
        $result = $mysqli->query($sql);

        if ($result == false)
        {
            throw new Exception($mysqli->error);
        }

        $mysqli->close();
    }

    public static function dohvati(int $id): ?object
    {
        $mysqli = Funkcije::dajMysqli();
        $tabela = static::imeTabele();
        $result = $mysqli->query("SELECT * FROM $tabela WHERE id = $id");

        if ($result == false)
        {
            throw new Exception($mysqli->error);
        }

        $obj = $result->fetch_object(static::class);
        return $obj;
    }

    public static function dohvatiSve(): array
    {
        $mysqli = Funkcije::dajMysqli();
        $tabela = static::imeTabele();
        $result = $mysqli->query("SELECT * FROM $tabela");

        if ($result == false)
        {
            throw new Exception($mysqli->error);
        }

        $arrResult = [];
        while ($obj = $result->fetch_object(static::class))
        {
            $arrResult[] = $obj;
        }

        $result->close();
        $mysqli->close();
        
        return $arrResult;
    }

    protected static function imeTabele(): string
    {
        $reflection = new ReflectionClass(static::class);
        return $reflection->getShortName();
    }
}