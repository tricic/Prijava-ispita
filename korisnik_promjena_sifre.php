<?php
spl_autoload_register();
Funkcije::zonaZaPrijavljene();

if (isset($_POST["promjena_sifre"]))
{
    $korisnik = Funkcije::prijavljeniKorisnik();
    $stara_sifra = $_POST["stara_sifra"];
    $nova_sifra = $_POST["nova_sifra"];

    if (password_verify($stara_sifra, $korisnik->sifra) == false)
    {
        $greske[] = "Pogrešna stara šifra!";
    }
    else
    {
        $korisnik->sifra($nova_sifra);
        $korisnik->azuriraj();
        $_GET["poruka"] = "Šifra promjenjena.";
    }
}
?>
<html>
    <?php require("partials/head.php"); ?>

    <body>
        <?php require("partials/header.php"); ?>

        <form action="korisnik_promjena_sifre.php" method="post">
            <fieldset>
                <legend>Unesite podatke</legend>

                <label>Stara šifra</label>
                <br>
                <input type="password" name="stara_sifra">

                <br>

                <label>Nova šifra</label>
                <br>
                <input type="password" name="nova_sifra">
            </fieldset>

            <br>
            <div style="text-align: right;">
                <input type="submit" name="promjena_sifre" value="Potvrdi" class="btn green">
            </div>
        </form>

        <?php require("partials/footer.php") ?>
    </body>
</html>