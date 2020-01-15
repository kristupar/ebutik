<?php
include 'inicijalizacija.php';
$folderSaSlikamaPutanja = "slike/";
$putanjaFajla = $folderSaSlikamaPutanja . basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $putanjaFajla)) {
    $slika = basename( $_FILES["fileToUpload"]["name"]);
    $nazivModela = $_POST['nazivModela'];
    $cena = $_POST['cena'];
    $kolekcijaID = $_POST['kolekcija'];

    $nizZaUnos = ['slika' => $slika, 'nazivModela' => $nazivModela, 'cena' => $cena, 'kolekcijaID' => $kolekcijaID];

    if($db->insert('odeca',$nizZaUnos)){
        header("Location: upravljanje.php?error=Uspesno uneta odeca");
    }else{
        header("Location: upravljanje.php?error=Doslo je do greske prilikom unosa");
    }
} else {
    header("Location: upravljanje.php?error=Doslo je do greske prilikom uplouda slike");
}
