<div class="header">
    <div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">
                    <h1><a href="index.php">E-Butik Kris</a></h1>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="prodavnica.php">Prodavnica</a></li>
                    <li><a href="korpa.php">Korpa</a></li>
                    <?php
                        if($_SESSION['ulogovan']){
                            ?>
                            <li><a href="zavrsiKupovinu.php">Zavrsi kupovinu</a></li>
                            <li><a href="mojeNarudzbine.php">Moje narudzbine</a></li>
                            <?php
                                if($_SESSION['privilegije'] == 'Upravljanje'){
                                   ?>
                                    <li><a href="upravljanje.php">Upravljanje</a></li>
                                    <?php
                                }
                            ?>
                            <li><a href="izlogujse.php">Izloguj se</a></li>
                            <?php
                        }else{
                            ?>
                            <li><a href="logovanje.php">Uloguj se</a></li>

                            <?php
                        }

                    ?>
                </ul>

            </div>
        </div>
    </nav>
</div>
</div>