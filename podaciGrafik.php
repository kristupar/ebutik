<?php
include "inicijalizacija.php";
$podaciZaGrafik = $db->podaciZaGrafik();
echo json_encode($podaciZaGrafik);