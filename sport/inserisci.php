<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento Sport</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>

        <div class="container-fluid">
            <?php

                include("../dati.php");
                
                $nome = $_POST['sport'];
                
                if( isset($_POST['sport']) && $_POST['sport']!="" ){

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");
                
                    $sql = "INSERT INTO sports VALUES (DEFAULT,\"".$nome."\")";

                    $query = mysqli_query($conn, $sql);
        
                    if($query)
                        echo "  <div class='col-md-4 offset-md-4 alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Sport inserito correttamente!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarli tutti.
                                </div>";
                    else 
                        echo "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nell'inserimento dello sport!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a>.
                                </div>";
                } else
                    echo "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'inserimento dello sport! Il nome non può essere vuoto.</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>.
                            </div>";
            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>