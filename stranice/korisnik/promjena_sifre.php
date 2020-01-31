<?php

use Helpers\Auth;

Auth::korisnikZona();

if (isset($_POST["promjena_sifre"]))
{
    $korisnik = Auth::prijavljeniKorisnik();
    $stara_sifra = $_POST["stara_sifra"];
    $nova_sifra = $_POST["nova_sifra"];

    if (empty($nova_sifra))
    {
        nova_greska("Nova šifra ne smije biti prazna.");
        preusmjeri("korisnik/promjena_sifre");
    }
    
    if (password_verify($stara_sifra, $korisnik->sifra) == false)
    {
        nova_greska("Šifra pogrešna.");
        preusmjeri("korisnik/promjena_sifre");
    }

    $korisnik->sifra($nova_sifra);
    $korisnik->azuriraj();
    nova_poruka("Šifra promijenjena, prijavite se ponovo koristeći novu šifru.");
    preusmjeri("korisnik/odjava");
}
?>
<fieldset class="mb-3">
    <form action="?akcija=korisnik/promjena_sifre" method="POST">
        <div class="form-group">
            <label>Stara šifra</label>
            <input type="password" name="stara_sifra" class="form-control">
        </div>

        <div class="form-group">
            <label>Nova šifra</label>
            <input type="password" name="nova_sifra" class="form-control">
        </div>

        <input type="submit" name="promjena_sifre" value="Potvrdi" class="btn btn-success">
    </form>
</fieldset>
