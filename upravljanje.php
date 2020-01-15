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
            </div>
        </div>

<?php include "footer.php";?>

</body>
</html>