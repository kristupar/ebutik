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
					<h2>Prodavnica</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="min">Minimalna cena</label>
                            <input type="number" id="min" value="1" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="max">Maksimalna cena</label>
                            <input type="number" id="max" value="1000000" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="sortiranje">Sortiranje</label>
                            <select id="sortiranje" class="form-control">
                                <option value="rastuce-cena">Rastuce po ceni</option>
                                <option value="opadajuce-cena">Opadajuce po ceni</option>
                                <option value="rastuce-nazivModela">Rastuce po nazivu</option>
                                <option value="opadajuce-nazivModela">Opadajuce po nazivu</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="pretrazivanje">Pretrazi</label>
                            <button id="pretrazivanje" class="form-control btn-primary" onclick="pretrazi()">Pretrazi</button>
                        </div>
                    </div>

                    <div class="trend-grids" id="prozivodi">

                        <div class="clearfix"></div>
                    </div>
				</div>
			</div>
		</div>

<?php include "footer.php";?>

<script>

    function pretrazi(){
        let sort = $("#sortiranje").val();
        let min = $("#min").val();
        let max = $("#max").val();
        $.ajax({
            url: 'prozivodiZaProdavnicu.php?sort='+sort+"&min="+min+"&max="+max,
            success: function (html) {
                $("#prozivodi").html(html);
            }
        })
    }
pretrazi();

</script>

</body>
</html>