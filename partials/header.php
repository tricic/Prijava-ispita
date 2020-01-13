<header>
    <div style="text-align: center;">
        <p style="font-size: 3rem; font-weight: bold; margin-bottom: 0px;">Prijava ispita</p>
        <p style="font-size: 0.8rem;">Projektni zadatak iz Web programiranja @ IPIA Tuzla</p>
    </div>

    <nav style="margin-bottom: 20px; margin-top: 10px;">
        <ul>
            <li><a href="/">Početna</a></li>
            <?php if (korisnikPrijavljen()) : ?>
                <li><a href="?akcija=korisnik/promjena_sifre">Promjena šifre</a></li>
                <li><a href="?akcija=korisnik/odjava">Odjava</a></li>
            <?php else : ?>
                <li><a href="?akcija=korisnik/prijava">Prijava</a></li>
                <li><a href="?akcija=korisnik/registracija">Registracija</a></li>
            <?php endif ?>
        
            <li><a href="?akcija=ispit/lista">Ispiti</a>
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