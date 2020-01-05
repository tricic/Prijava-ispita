<?php
spl_autoload_register();

use Entiteti\Korisnik;

if (isset($_POST["prijava"]))
{
    $korisnicko_ime = $_POST["korisnicko_ime"];
    $sifra = $_POST["sifra"];

    var_dump(Korisnik::prijava($korisnicko_ime, $sifra));
}
?>
<html>

<?php require('partials/head.html'); ?>

<body>

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