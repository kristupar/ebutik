<?php

include "inicijalizacija.php";
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';

$kolekcije = $db->select('kolekcija');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>E-Butik Kris</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<link href='//fonts.googleapis.com/css?family=Oregano' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
		<?php include "header.php";?>

		<div class="content">	
			<div class="update">
				<div class="container">
					<h2>Upravljanje prodavnicom</h2>
					<?php
                        if($errorMessage != ''){
                            ?>
                        <div class="alert alert-danger">
                            <?= $errorMessage ?>
                        </div>
                    <?php
                        }
                    ?>
                    <form method="POST" action="unesiOdecu.php" enctype="multipart/form-data">
                        <label for="nazivModela">Naziv modela</label>
                        <input id="nazivModela" name="nazivModela" class="form-control" type="text">
                        <label for="cena">Cena</label>
                        <input id="cena" name="cena" class="form-control" type="number">
                        <label for="kolekcija">Kolekcija</label>
                        <select id="kolekcija" name="kolekcija" class="form-control">
                            <?php
                            foreach ($kolekcije as $kolekcija){
                                ?>
                            <option value="<?= $kolekcija->kolekcijaID ?>"><?= $kolekcija->nazivKolekcije ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="fileToUpload">Slika</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                        <hr>
                        <input type="submit" value="Unesi odecu" class="btn-primary btn btn-lg">
                    </form>
                </div>
                <div class="container">
                    <h2 id="odgovor"></h2>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table" id="narudzbine">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Ukupna cena</th>
                                    <th class="text-center">Datum</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Potvrdi narudzbinu</th>
                                    <th class="text-center">Ponisti narudzbinu</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost/ebutik/api/narudzbineSaStatusomObrade');
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                $rez = curl_exec($ch);

                                $narudzbine = json_decode($rez);
                                curl_close($ch);

                                foreach ($narudzbine as $nar) {

                                    ?>
                                    <tr>
                                        <td><?php echo $nar->narudzbinaID ?></td>
                                        <td><?php echo $nar->ukupanIznos ?> dinara</td>
                                        <td><?php echo $nar->datum ?></td>
                                        <td><?php echo $nar->status ?></td>
                                        <td><button class="btn btn-primary" onclick="promeniStatus(<?php echo $nar->narudzbinaID ?>,'Potvrdjeno')">Potvrdi</button> </td>
                                        <td><button class="btn btn-danger" onclick="promeniStatus(<?php echo $nar->narudzbinaID ?>,'Odbijeno')">Ponisti</button> </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div id="piechart_3d" style="width: 500px; height: 400px;"></div>                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="korisnici">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Ime i prezime</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'http://localhost/ebutik/api/korisnici');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            $rez = curl_exec($ch);

                            $korisnici = json_decode($rez);
                            curl_close($ch);

                            foreach ($korisnici as $kor) {

                                ?>
                                <tr>
                                    <td><?php echo $kor->korisnikid ?></td>
                                    <td><?php echo $kor->imeIPrezimeKorisnika ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container" id="slikice">

                </div>
            </div>
        </div>

<?php include "footer.php";?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                let nizPodataka = [];
                let header = ['Odeca', 'Broj kupovina'];
                nizPodataka.push(header);

                $.ajax({
                    url: 'podaciGrafik.php',
                    success: function (podaci) {
                        let niz = JSON.parse(podaci);
                        $.each(niz, function (i,element) {
                            let n = [element.nazivModela,parseInt(element.brojKupovina)]
                            nizPodataka.push(n);
                        });
                        var data = google.visualization.arrayToDataTable(nizPodataka);
                        var options = {
                            title: 'Broj kupovina po odeci',
                            is3D: true,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                        chart.draw(data, options);
                    }
                });
            }
        </script>
        <script>
            function promeniStatus(id,status) {
                $.ajax({
                    url: 'promeniStatusNarudzbine.php?status='+status+"&id="+id,
                    success: function (odgovor) {
                        $("#odgovor").html(odgovor);
                    }
                })
            }
        </script>
<script>
    $.ajax({
        url: 'slikeSaJavnogVebServisa.php',
        success: function (slike) {
            $("#slikice").html(slike);
        }
    })
</script>
</body>
</html>