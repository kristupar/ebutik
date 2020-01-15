<?php
require 'flight/Flight.php';
require '../inicijalizacija.php';

Flight::register('db', 'Database', array(''));

Flight::route('/', function(){
    echo 'Rute koje mozete da koristite.'. PHP_EOL;
    echo 'GET /odeca.'. PHP_EOL;
    echo 'GET /korisnici.'. PHP_EOL;
    echo 'GET /narudzbineSaStatusomObrade.'. PHP_EOL;
    echo 'GET /stavkeNarudzbine/1'. PHP_EOL;
});

Flight::route('GET /odeca', function(){
    header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
    $rezultati = $db->vratiOdecu();
    echo json_encode($rezultati);
});

Flight::route('GET /korisnici', function(){
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $rezultati = $db->vratiKorisnike();
    echo json_encode($rezultati);
});

Flight::route('GET /narudzbineSaStatusomObrade', function(){
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $rezultati = $db->vratiNarudzbineSaStatusomObrada();
    echo json_encode($rezultati);
});

Flight::route('GET /stavkeNarudzbine/@id', function($id){
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $rezultati = $db->vratiStavkeZaNarudzbinu($id);
    echo json_encode($rezultati);
});

Flight::start();
