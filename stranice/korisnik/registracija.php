<?php

use Entiteti\Korisnik;
use Helpers\Auth;

if (Auth::korisnikJePrijavljen())
{
    nova_poruka("Već ste registrovani i prijavljeni.");
    preusmjeri("");
}

if (isset($_POST["registracija"]))
{
    $korisnik = new Korisnik();
    $korisnik->korisnicko_ime = $_POST["korisnicko_ime"];
    $korisnik->ime = $_POST["ime"];
    $korisnik->prezime = $_POST["prezime"];
    $korisnik->email = $_POST["email"];
    $korisnik->sifra($_POST["sifra"]);

    $greske = $korisnik->validacijaZaUnos();

    if (empty($greske))
    {
        $korisnik->unesi();
        nova_poruka("Registracija uspješna. Možete se prijaviti.");
        preusmjeri("korisnik/prijava");
    }
    else
    {
        $korisnik->sifra = "";
        prenesi_varijablu("korisnik", $korisnik);
        nova_greska($greske);
        preusmjeri("korisnik/registracija");
    }
}
?>
<fieldset class="mb-3">
    <form action="?akcija=korisnik/registracija" method="POST">
        <div class="form-group">
            <label>Korisničko ime</label>
            <input type="text" name="korisnicko_ime" class="form-control" value="<?= $korisnik->korisnicko_ime ?? null ?>">
        </div>
    
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $korisnik->email ?? null ?>">
        </div>
    
        <div class="form-group">
            <label>Ime</label>
            <input type="text" name="ime" class="form-control" value="<?= $korisnik->ime ?? null ?>">
        </div>
    
        <div class="form-group">
            <label>Prezime</label>
            <input type="text" name="prezime" class="form-control" value="<?= $korisnik->prezime ?? null ?>">
        </div>
    
        <div class="form-group">
            <label>Šifra</label>
            <input type="password" name="sifra" class="form-control">
        </div>
    
        <input type="submit" name="registracija" value="Potvrdi" class="btn btn-success">
    </form>
</fieldset>
