<?php

include "inicijalizacija.php";

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
					<h2 id="odgovor"></h2>
                    <?php

                    if (empty($_SESSION['korpa'])){
                        echo "<h4>Nemate odece u korpi.</h4>";
                    }else{
                    ?>
					<table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">Odeca</th>
                            <th class="text-center">Kolicina</th>
                            <th class="text-center">Cena</th>
                            <th class="text-center">Ukupno</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                            $idjeviOdeceUKorpi = implode(",",array_keys($_SESSION['korpa']));
                            $odecaZaIdijeve = $db->vratiOdecuZaIdijeve($idjeviOdeceUKorpi);

                            $ukupno = 0;

                        foreach ($odecaZaIdijeve as $item) {
                            $ukupnoStavka = $_SESSION['korpa'][$item->odecaID]['kolicina'] * $item->cena;
                            $ukupno += $ukupnoStavka;

                            ?>
                            <tr>
                                <td><?php echo $item->nazivModela ?></td>
                                <td><?php echo $_SESSION['korpa'][$item->odecaID]['kolicina'] ?></td>
                                <td><?php echo $item->cena ?> dinara</td>
                                <td><?php echo $ukupnoStavka ?> dinara</td>
                            </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="4">Ukupna cena: <?php echo $ukupno ?> dinara</td>
                        </tr>
                        </tbody>
                    </table>
                        <hr>
                        <button id="zavrsiKupovinu" role="button" class="btn btn-primary btn-lg" onclick="zavrsi()">Zavrsi kupovinu </button>

                    <?php } ?>
				</div>
			</div>
		</div>

<?php include "footer.php";?>
        <script>

            function zavrsi(){

                $.ajax({
                    url: "zavrsi.php",
                    success: function(data){

                        $('#odgovor').html(data);
                    }});
            }

        </script>
</body>
</html>