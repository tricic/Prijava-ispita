<?php

zonaZaPrijavljene();

if (isset($_POST["promjena_sifre"]))
{
    $korisnik = prijavljeniKorisnik();
    $stara_sifra = $_POST["stara_sifra"];
    $nova_sifra = $_POST["nova_sifra"];

    if (password_verify($stara_sifra, $korisnik->sifra) == false)
    {
        $_GET["poruka"] = "Pogrešna stara šifra!";
    }
    else
    {
        $korisnik->sifra($nova_sifra);
        $korisnik->azuriraj();
        $_GET["poruka"] = "Šifra promijenjena.";
    }
}
?>
<html>
<form action="?akcija=korisnik/promjena_sifre" method="post">
    <fieldset>
        <legend>Unesite podatke</legend>

        <label>Stara šifra</label>
        <br>
        <input type="password" name="stara_sifra">

        <br>

        <label>Nova šifra</label>
        <br>
        <input type="password" name="nova_sifra">
    </fieldset>

    <br>
    <div style="text-align: right;">
        <input type="submit" name="promjena_sifre" value="Potvrdi" class="btn green">
    </div>
</form>