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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf-6.4.3/dt-1.10.20/datatables.min.css"/>
</head>
<body>
		<?php include "header.php";?>

		<div class="content">	
			<div class="update">
				<div class="container">
					<h2 id="odgovor"></h2>
					<table class="table" id="narudzbine">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Ukupna cena</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                            $narudzbine = $db->vratiNarudzbineZaKorisnika($_SESSION['id']);

                        foreach ($narudzbine as $nar) {

                            ?>
                            <tr>
                                <td><?php echo $nar->narudzbinaID ?></td>
                                <td><?php echo $nar->ukupanIznos ?> dinara</td>
                                <td><?php echo $nar->status ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>

				</div>
			</div>
		</div>

<?php include "footer.php";?>
        <script type="text/javascript" src="https://cdn.datatables.net/v/zf-6.4.3/dt-1.10.20/datatables.min.js"></script>
        <script>

            $("#narudzbine").dataTable();

        </script>
</body>
</html>