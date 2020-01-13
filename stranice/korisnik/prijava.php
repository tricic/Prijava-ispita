<?php

use Entiteti\Korisnik;

zonaZaNeprijavljene();

if (isset($_POST["prijava"]))
{
    $korisnicko_ime = $_POST["korisnicko_ime"];
    $sifra = $_POST["sifra"];
    $korisnik = Korisnik::dohvati("korisnicko_ime", $korisnicko_ime);

    if (is_null($korisnik))
    {
        $_GET["greska"] = "Korisnik ne postoji!";
    }
    else if (password_verify($sifra, $korisnik->sifra) == false)
    {
        $_GET["greska"] = "Pogrešna šifra!";
    }
    else
    {
        $_SESSION["korisnik_prijavljen"] = true;
        $_SESSION["korisnik_id"] = (int)$korisnik->id;
        $poruka = "Dobrodošli!";
        header("Location: index.php?poruka=$poruka");
    }
}
?>
<form action="?akcija=korisnik/prijava" method="POST">
    <fieldset>
        <legend>Unesite podatke</legend>

        <label>Korisničko ime</label>
        <br>
        <input type="text" name="korisnicko_ime" />
        
        <br>
        
        <label>Šifra</label>
        <br>
        <input type="password" name="sifra" />
    </fieldset>
    
    <br>
    <div style="text-align: right;">
        <input type="submit" name="prijava" value="Potvrdi" class="btn green">
    </div>
</form>