<?php
 require("inicijalizacija.php");
 $id=intval($_GET['id']);

 if(isset($_SESSION['korpa'][$id])){
    header("Location: korpa.php");
}else{
    $odeca = $db->vratiOdecuPoIdu($id);

   if($odeca){
       $_SESSION['korpa'][$odeca->odecaID] = [
           "kolicina" => 1,
           "cena" => $odeca->cena
       ];

           header("Location: prodavnica.php");

   }else{

       die("Nema odece sa tim id-em");

   }

       }
  ?>
