<?php
include "inicijalizacija.php";

$sort = $_GET['sort'];
$min = (int) $_GET['min'];
$max = (int) $_GET['max'];

$sortiranje = explode("-",$sort);

$prozivodi = $db->vratiOdecuSortirano($sortiranje,$min,$max);

foreach ($prozivodi as $pro){
    ?>
    <div class="col-md-3 trend-grid">
        <img src="slike/<?= $pro->slika ?>" class="img-responsive" alt=""/>
        <div class="trend-info">
            <h4> <?= $pro->nazivModela ?></h4>
            <p>Cena: <?= $pro->cena ?> dinara</p>
            <p><?= $pro->nazivKolekcije ?> </p>
            <a href="dodajUKorpu.php?id=<?= $pro->odecaID ?>" class="btn btn-primary">Dodaj u korpu</a>
        </div>
    </div>

<?php
}