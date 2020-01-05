<?php
spl_autoload_register();

use Entiteti\{Korisnik, Predmet, Ispit, Ispit_Korisnik};

try
{
    $korisnik = new Korisnik();
    $korisnik->id = 2;
    $korisnik->korisnicko_ime = "korisnik5";
    $korisnik->email = "korisnik5@mail.com";
    $korisnik->sifra = "korisnik5";
    $korisnik->ime = "K5Ime";
    $korisnik->prezime = "K5Prezime";
    //$korisnik->Unesi();

    $predmet = new Predmet();
    $predmet->id = 2;
    $predmet->naziv = "Predmet C";
    $predmet->godina = 2;
    $predmet->semestar = 3;
    $predmet->profesor = "Neki Profesor 3";
    $predmet->predavac = "Neki Profesor 3";
    //$predmet->Unesi();

    $ispit = new Ispit();
    $ispit->predmet_id = 1;
    $ispit->opis = "test 1";
    $ispit->datum = new DateTime("2020-01-05 12:00");
    $ispit->pocetak_prijave = new DateTime();
    $ispit->kraj_prijave = new DateTime("2020-01-04 23:59");
    $ispit->aktivan = true;
    //$ispit->Unesi();

    $ispit_korisnik = new Ispit_Korisnik();
    $ispit_korisnik->ispit_id = 1;
    $ispit_korisnik->korisnik_id = 2;
    //$ispit_korisnik->Unesi();

    /** @var Ispit */
    $ispit = Ispit::Dohvati(1);
    //var_dump($ispit->DohvatiPrijavljeneKorisnike());

    var_dump(Korisnik::Dohvati(1));
    
}
catch (Exception $e)
{
    print($e);
    die;
}