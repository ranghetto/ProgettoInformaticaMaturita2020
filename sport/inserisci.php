<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento Nazione</title>
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
                        echo "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Sport inserito correttamente!</strong> Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarli tutti.
                                </div>";
                    else 
                        echo "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nell'inserimento dello sport!</strong>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a>
                                    oppure <a href='./inserisci.php' class='alert-link'>riprova</a>.
                                </div>";
                } else
                    echo "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'inserimento dello sport! Il nome non può essere vuoto.</strong>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./inserisci.php' class='alert-link'>riprova</a>.
                            </div>";
            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>