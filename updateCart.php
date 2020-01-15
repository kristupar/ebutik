<?php
include("inicijalizacija.php");
if(isset($_POST['submit'])){

    foreach($_POST['kolicina'] as $key => $val) {
        if($val==0) {
            unset($_SESSION['korpa'][$key]);
        }else{
            $_SESSION['korpa'][$key]['kolicina']=$val;
        }
    }

    header("Location: korpa.php");

}
?>
