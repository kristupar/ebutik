<?php

include "inicijalizacija.php";
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
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
					<h2>Registracija</h2>
					<?php
                        if($errorMessage != ''){
                            ?>
                        <div class="alert alert-info">
                            <?= $errorMessage ?>
                        </div>
                    <?php
                        }
                    ?>
                    <form method="POST" action="registruj.php">
                        <label for="ime">Ime i prezime</label>
                        <input id="ime" name="ime" class="form-control" type="text">
                        <label for="korisnickoIme">Korisnicko ime</label>
                        <input id="korisnickoIme" name="korisnickoIme" class="form-control" type="text">
                        <label for="korisnickaLozinka">Korisnicka lozinka</label>
                        <input id="korisnickaLozinka" name="korisnickaLozinka" class="form-control" type="password">
                        <hr>
                        <input type="submit" value="Registruj se" class="btn-primary btn btn-lg">
                    </form>
                </div>
            </div>
        </div>

<?php include "footer.php";?>

</body>
</html>