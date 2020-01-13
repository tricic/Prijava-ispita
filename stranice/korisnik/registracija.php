<?php

use Entiteti\Korisnik;

zonaZaNeprijavljene();

if (isset($_POST["registracija"]))
{
    $korisnik = new Korisnik();
    $korisnik->korisnicko_ime = $_POST["korisnicko_ime"];
    $korisnik->ime = $_POST["ime"];
    $korisnik->prezime = $_POST["prezime"];
    $korisnik->email = $_POST["email"];
    $korisnik->sifra($_POST["sifra"]);
    $korisnik->unesi();
    $poruka = "Registracija uspješna. Možete se prijaviti.";
    header("Location: korisnik/prijava.php?poruka=$poruka");
}
?>
<form action="?akcija=korisnik/registracija" method="post">
    <fieldset>
        <legend>Unesite podatke</legend>

        <label>Korisničko ime</label>
        <br>
        <input type="text" name="korisnicko_ime" />

        <br>

        <label>Email</label>
        <br>
        <input type="text" name="email" />

        <br>

        <label>Ime</label>
        <br>
        <input type="text" name="ime" />

        <br>
        
        <label>Prezime</label>
        <br>
        <input type="text" name="prezime" />

        <br>

        <label>Šifra</label>
        <br>
        <input type="password" name="sifra" />
    </fieldset>

    <br>

    <div style="text-align: right;">
        <input type="submit" name="registracija" value="Potvrdi" class="btn green">
    </div>
</form>