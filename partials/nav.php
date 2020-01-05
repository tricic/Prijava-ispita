<ul>
    <li><a href="/">Index</a></li>
    <?php if (Funkcije::korisnikPrijavljen()) : ?>
        <li><a href="odjava.php">Odjava</a></li>
    <?php else : ?>
        <li><a href="prijava.php">Prijava</a></li>
        <li><a href="registracija.php">Registracija</a></li>
    <?php endif ?>
</ul>