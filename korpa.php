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
					<h2>Morate biti ulogovani da biste zavrsili kupovinu</h2>
                    <?php

                    if (empty($_SESSION['korpa'])){
                        echo "<h4>Nemate odece u korpi.</h4>";
                    }else{
                    ?>
                    <form method="post" action="updateCart.php">
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
                                <td><input class="form-control" type="text" name="kolicina[<?php echo $item->odecaID ?>]" size="5" value="<?php echo $_SESSION['korpa'][$item->odecaID]['kolicina'] ?>" style="border: 1px solid black;"/></td>
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
                        <button class="btn btn-lg btn-primary" type="submit" name="submit">Promeni kolicine</button>

                    </form>
                    <p>Za brisanje proizvoda stavite kolicinu na nulu. </p>
                    <?php } ?>
				</div>
			</div>
		</div>

<?php include "footer.php";?>

</body>
</html>