<?php
include("inicijalizacija.php");

$idjeviOdeceUKorpi = implode(",",array_keys($_SESSION['korpa']));
$odecaZaIdijeve = $db->vratiOdecuZaIdijeve($idjeviOdeceUKorpi);

$ukupno = 0;

foreach ($odecaZaIdijeve as $item) {
    $ukupnoStavka = $_SESSION['korpa'][$item->odecaID]['kolicina'] * $item->cena;
    $ukupno += $ukupnoStavka;
}
$now =date("Y-m-d H:i:s");
$korisnikID = $_SESSION['id'];

$podaciNarudzbina = [
    'datum' => $now,
    'ukupanIznos' => $ukupno,
    'korisnikID' => $korisnikID,
    'status' => 'U procesu obrade'
];

if($db->insert("narudzbina",$podaciNarudzbina)){
    $last_id = $db->vratiID();

    foreach ($odecaZaIdijeve as $item) {
        $kolicina = $_SESSION['korpa'][$item->odecaID]['kolicina'];
        $id = $item->odecaID;

        $podaciStavka = [
            'narudzbinaID' => $last_id,
            'odecaID' => $id,
            'kolicina' => $kolicina
        ];
        $db->insert('stavkaNarudzbine',$podaciStavka);
    }

    $_SESSION['korpa'] = [];

    echo('USPESNO STE KUPILI ODECU.');
}else{
    echo('Neuspesno ubacivanje narudzbine');
};
?>
