<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifica Sport</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>    
        <div class="container-fluid">
            <?php

                include("../dati.php");

                // Controllo che l'id della nazione esista
                if( isset($_POST['idSport']) || ( isset($_POST['sport']) && $_POST['sport']!="" ) ){
                    $id = $_POST['idSport'];
                    $nome = $_POST['sport'];

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                                or die("Impossibile connettersi al database.");
                    
                    $sql = "UPDATE sports SET sport = \"".$nome."\" WHERE idSport = ".$id;

                    $query = mysqli_query($conn, $sql);

                    if($query)
                        echo "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Sport modificato con successo!</strong> Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarli tutti.
                                </div>";
                    else
                        echo "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nella modifica dello sport!</strong>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a>
                                    oppure <a href='./modifica.php?idNazione=".$id."' class='alert-link'>riprova</a>.
                                </div>";
                } else
                    echo "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nella modifica dello sport! Il nome non può essere vuoto.</strong>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./modifica.php?idNazione=".$id."' class='alert-link'>riprova</a>.
                            </div>";

            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>