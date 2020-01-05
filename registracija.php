<?php
spl_autoload_register();

use Entiteti\Korisnik;

if (isset($_POST["registracija"]))
{
    try
    {
        $korisnik = new Korisnik();
        $korisnik->korisnicko_ime = $_POST["korisnicko_ime"];
        $korisnik->ime = $_POST["ime"];
        $korisnik->prezime = $_POST["prezime"];
        $korisnik->email = $_POST["email"];
        $korisnik->sifra($_POST["sifra"]);
        $korisnik->unesi();
    }
    catch(Exception $e)
    {
        var_dump($e);
    }
}
?>
<?php
require("partials/head.html");
require("partials/nav.html");
?>
<form action="registracija.php" method="post">
    <label>Korisničko ime:</label>
    <input type="text" name="korisnicko_ime" />

    <br>

    <label>Email:</label>
    <input type="text" name="email" />

    <br>

    <label>Ime:</label>
    <input type="text" name="ime" />

    <br>
    
    <label>Prezime:</label>
    <input type="text" name="prezime" />

    <br>

    <label>Šifra:</label>
    <input type="text" name="sifra" />

    <br>

    <input type="submit" name="registracija" />
</form>