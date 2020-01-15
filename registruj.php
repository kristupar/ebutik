<?php
include 'inicijalizacija.php';
$imeIPrezime = $_POST['ime'];
$ime = $_POST['korisnickoIme'];
$lozinka = $_POST['korisnickaLozinka'];

$podaci = [
'imeIPrezimeKorisnika' => $imeIPrezime,
    'korisnickoIme' => $ime,
    'korisnickaSifra' => $lozinka,
    'ulogaUSistemu' => "Korisnik"
];

$uspesno = $db->insert("korisnik",$podaci);

if($uspesno){
    header("Location: registrovanje.php?error=Uspesna registracija.Mozete se ulogovati.");
}else{
    header("Location: registrovanje.php?error=Doslo je do greske.");
}