<?php

use Entiteti\Korisnik;
use Helpers\Auth;

if (Auth::korisnikJePrijavljen())
{
    preusmjeri("", ["poruka" => "Već ste registrovani i prijavljeni."]);
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
        preusmjeri("korisnik/prijava", ["poruka" => "Registracija uspješna. Možete se prijaviti."]);
    }
}
?>
<form action="?akcija=korisnik/registracija" method="post">
    <fieldset>
        <legend>Unos podataka</legend>

        <label>Korisničko ime</label>
        <br>
        <input type="text" name="korisnicko_ime" value="<?= $korisnik->korisnicko_ime ?? null ?>" onkeyup="validirajInput(this, 'korisnicko_ime_greska')" />
        <div class="red-font smaller-font" id="korisnicko_ime_greska"></div>

        <br>

        <label>Email</label>
        <br>
        <input type="email" name="email" value="<?= $korisnik->email ?? null ?>" onkeyup="validirajInput(this, 'email_greska')" />
        <div class="red-font smaller-font" id="email_greska"></div>

        <br>

        <label>Ime</label>
        <br>
        <input type="text" name="ime" value="<?= $korisnik->ime ?? null ?>" onkeyup="validirajInput(this, 'ime_greska')" />
        <div class="red-font smaller-font" id="ime_greska"></div>

        <br>
        
        <label>Prezime</label>
        <br>
        <input type="text" name="prezime" value="<?= $korisnik->prezime ?? null ?>" onkeyup="validirajInput(this, 'prezime_greska')" />
        <div class="red-font smaller-font" id="prezime_greska"></div>

        <br>

        <label>Šifra</label>
        <br>
        <input type="password" name="sifra" onkeyup="validirajInput(this, 'sifra_greska')" />
        <div class="red-font smaller-font" id="sifra_greska"></div>

        <?php
            if (empty($greske) == false) : 
            foreach ($greske as $greska) : 
        ?>
            <div class="red-font smaller-font"><?= $greska ?></div>
        <?php
            endforeach;
            endif;
        ?>
    </fieldset>

    <br>

    <div style="text-align: right;">
        <input type="submit" name="registracija" value="Potvrdi" class="btn green">
    </div>
</form>