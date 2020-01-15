<?php
include 'inicijalizacija.php';

$ime = $_POST['korisnickoIme'];
$lozinka = $_POST['korisnickaLozinka'];

$korisnik = $db->login($ime,$lozinka);

if($korisnik){
    $_SESSION['ulogovan'] = true;
    $_SESSION['privilegije'] = $korisnik->ulogaUSistemu == 'Administrator' ? 'Upravljanje' : 'Nema';
    $_SESSION['id'] = $korisnik->korisnikID;
    $_SESSION['imePrezimeKorisnika'] = $korisnik->imeIPrezimeKorisnika;
    header("Location: prodavnica.php");
}else{
    header("Location: logovanje.php?error=Doslo je do greske. Proverite da li je uneta ispravna lozinka i korisnicko ime");
}