<?php

use Entiteti\Korisnik;
use Helpers\Auth;

if (Auth::korisnikJePrijavljen())
{
    nova_poruka("Već ste prijavljeni.");
    preusmjeri("");
}

if (isset($_POST["prijava"]))
{
    $korisnicko_ime = $_POST["korisnicko_ime"];
    $sifra = $_POST["sifra"];
    $korisnik = Korisnik::dohvati("korisnicko_ime", $korisnicko_ime);

    if (is_null($korisnik))
    {
        nova_greska("Korisnički račun ne postoji!");
        preusmjeri("korisnik/prijava");

    }
    else if (password_verify($sifra, $korisnik->sifra) == false)
    {
        nova_greska("Pogrešna šifra!");
        preusmjeri("korisnik/prijava");
    }
    else
    {
        $_SESSION["korisnik_prijavljen"] = true;
        $_SESSION["korisnik_id"] = (int)$korisnik->id;
        nova_poruka("Dobrodošli!");
        preusmjeri("");
    }
}
?>
<fieldset class="mb-3">
    <form action="?akcija=korisnik/prijava" method="POST">
        <div class="form-group">
            <label>Korisničko ime</label>
            <input type="text" name="korisnicko_ime" class="form-control">
        </div>
    
        <div class="form-group">
            <label>Šifra</label>
            <input type="password" name="sifra" class="form-control">
        </div>
        
        <input type="submit" name="prijava" value="Potvrdi" class="btn btn-success">
    </form>
</fieldset>
