<?php

use Helpers\Auth;

Auth::korisnikZona();

if (isset($_POST["promjena_sifre"]))
{
    $korisnik = Auth::prijavljeniKorisnik();
    $stara_sifra = $_POST["stara_sifra"];
    $nova_sifra = $_POST["nova_sifra"];
    $greska = false;

    if (empty($nova_sifra))
    {
        $greska = true;
        $nova_sifra_prazna = true;
    }
    
    if (password_verify($stara_sifra, $korisnik->sifra) == false)
    {
        $greska = true;
        $sifra_pogresna = true;
    }

    if ($greska == false)
    {
        $korisnik->sifra($nova_sifra);
        $korisnik->azuriraj();
        preusmjeri("korisnik/odjava", ["poruka" => "Šifra promijenjena, prijavite se ponovo koristeći novu šifru."]);
    }
}
?>
<form action="?akcija=korisnik/promjena_sifre" method="post">
    <fieldset>
        <legend>Unos podataka</legend>

        <label>Stara šifra</label>
        <br>
        <input type="password" name="stara_sifra">
        <?php if (isset($sifra_pogresna)) : ?>
            <div class="red-font smaller-font">Šifra pogrešna.</div>
        <?php endif ?>

        <br>

        <label>Nova šifra</label>
        <input type="password" name="nova_sifra">
        <?php if (isset($nova_sifra_prazna)) : ?>
            <div class="red-font smaller-font">Šifra ne smije biti prazna.</div>
        <?php endif ?>
        
        <br>
    </fieldset>

    <br>
    <div style="text-align: right;">
        <input type="submit" name="promjena_sifre" value="Potvrdi" class="btn green">
    </div>
</form>