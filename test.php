<?php
include "inicijalizacija.php";
$niz = [
    '1' => 'nesto',
    '2' => 4,
    '5' => 'car'
];

$drugi = array_keys($niz);
$idjeviOdeceUKorpi = implode(",",array_keys($_SESSION['korpa']));

echo $idjeviOdeceUKorpi;