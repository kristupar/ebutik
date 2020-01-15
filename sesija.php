<?php
session_start();

if(!isset($_SESSION['ulogovan'])){
    $_SESSION['ulogovan'] = false;
    $_SESSION['privilegije'] = "Nema";
    $_SESSION['id'] = -1;
    $_SESSION['imePrezimeKorisnika'] = "/";
}

if(!isset($_SESSION['korpa'])){
    $_SESSION['korpa'] = [];
}