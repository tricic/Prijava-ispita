<?php

spl_autoload_register();

use Entiteti\Korisnik;

if (Funkcije::korisnikPrijavljen())
{
    header("Location: /index.php");
}

if (isset($_POST["prijava"]))
{
    try
    {
        $korisnicko_ime = $_POST["korisnicko_ime"];
        $sifra = $_POST["sifra"];
        $korisnik = Korisnik::prijava($korisnicko_ime, $sifra);
    }
    catch (GreskeException $e)
    {
        $greske = $e->greske;
    }
}
?>
<html>
<?php require("partials/head.php"); ?>
<body>

<?php require("partials/nav.php"); ?>
<?php require("partials/poruke.php"); ?>

<form action="prijava.php" method="POST">
    <label>Korisničko ime:</label>
    <input type="text" name="korisnicko_ime" />

    <br>

    <label>Šifra:</label>
    <input type="password" name="sifra" />

    <br>
    <input type="submit" name="prijava" />
</form>

</body>
</html>