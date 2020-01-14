<?php

use Entiteti\Korisnik;

if (korisnikPrijavljen())
{
    preusmjeri("", ["poruka" => "Već ste prijavljeni."]);
}

if (isset($_POST["prijava"]))
{
    $korisnicko_ime = $_POST["korisnicko_ime"];
    $sifra = $_POST["sifra"];
    $korisnik = Korisnik::dohvati("korisnicko_ime", $korisnicko_ime);

    if (is_null($korisnik))
    {
        $korisnik_nepostojeci = true;
    }
    else if (password_verify($sifra, $korisnik->sifra) == false)
    {
        $sifra_pogresna = true;
    }
    else
    {
        $_SESSION["korisnik_prijavljen"] = true;
        $_SESSION["korisnik_id"] = (int)$korisnik->id;
        preusmjeri("", ["poruka" => "Dobrodošli!"]);
    }
}
?>
<form action="?akcija=korisnik/prijava" method="POST">
    <fieldset>
        <legend>Unos podataka</legend>

        <label>Korisničko ime</label>
        <br>
        <input type="text" name="korisnicko_ime" />
        <?php if (isset($korisnik_nepostojeci)) : ?>
            <div class="red-font smaller-font">Korisnički račun ne postoji.</div>
        <?php endif ?>
        
        <br>
        
        <label>Šifra</label>
        <br>
        <input type="password" name="sifra" />
        <?php if (isset($sifra_pogresna)) : ?>
            <div class="red-font smaller-font">Šifra pogrešna.</div>
        <?php endif ?>
    </fieldset>
    
    <br>
    <div style="text-align: right;">
        <input type="submit" name="prijava" value="Potvrdi" class="btn green">
    </div>
</form>