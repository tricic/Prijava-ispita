<?php

use Entiteti\Korisnik;
use Helpers\Auth;

if (Auth::korisnikJePrijavljen())
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
        <input type="text" name="korisnicko_ime" id="korisnicko_ime" onkeyup="validirajInput(this, 'korisnicko_ime_greska')" />
        <div class="red-font smaller-font" id="korisnicko_ime_greska"><?= isset($korisnik_nepostojeci) ? "Korisnički račun ne postoji." : null ?></div>
        
        <br>
        
        <label>Šifra</label>
        <br>
        <input type="password" name="sifra" onkeyup="validirajInput(this, 'sifra_greska')" />
        <div class="red-font smaller-font" id="sifra_greska"><?= isset($sifra_pogresna) ? "Pogrešna šifra." : null ?></div>
    </fieldset>
    
    <br>
    <div style="text-align: right;">
        <input type="submit" name="prijava" value="Potvrdi" class="btn green">
    </div>
</form>