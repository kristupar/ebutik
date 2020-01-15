<?php
$konekcija = new Mysqli('localhost','root','','ebutik');
$konekcija->set_charset("utf8");

if($konekcija->connect_errno) {
    die('Neuspela konekcija na bazu!');
}