<header>
    <div style="text-align: center;">
        <p style="font-size: 3rem; font-weight: bold; margin-bottom: 0px;">Prijava ispita</p>
        <p style="font-size: 0.8rem;">Projektni zadatak iz Web programiranja @ IPIA Tuzla</p>
    </div>

    <nav style="margin-bottom: 20px; margin-top: 10px;">
        <ul>
            <li><a href="/">Početna</a></li>
            <?php if (Funkcije::korisnikPrijavljen()) : ?>
                <li><a href="korisnik_promjena_sifre.php">Promjena šifre</a></li>
                <li><a href="korisnik_odjava.php">Odjava</a></li>
            <?php else : ?>
                <li><a href="korisnik_prijava.php">Prijava</a></li>
                <li><a href="korisnik_registracija.php">Registracija</a></li>
            <?php endif ?>
        
            <li><a href="ispit_lista.php">Ispiti</a>
        </ul>
    </nav>

    <?php
        if (isset($_GET["greska"]))
        {
            print "<p class='msg red-border'>{$_GET['greska']}</p>";
        }
        
        if (isset($_GET["poruka"]))
        {
            print "<p class='msg blue-border'>{$_GET['poruka']}</p>";
        }
        
        if (empty($greske) == false)
        {
            foreach ($greske as $greska)
            {
                print $greska . "<hr>";
            }
        }
    ?>
</header>