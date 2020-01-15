<?php
include "inicijalizacija.php";
$status = $_GET['status'];
$id = $_GET['id'];
if($db->promeniStatus($id,$status)){
    echo "Status uspesno promenjen";
}else{
    echo "Doslo je do greske prilikom promene statusa";
}