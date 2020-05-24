<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Elimina Sport</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>
        <div class="container-fluid">
            <?php

                include("../dati.php");

                $id = $_GET['idSport'];

                $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");

                $sql = "DELETE FROM sports WHERE idSport = ".$id;

                $query = mysqli_query($conn, $sql);

                if($query)
                    echo "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sport eliminato con successo!</strong> Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarli tutti.
                            </div>";
                else
                    echo "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'eliminazione dello sport!</strong>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./elimina.php?idNazione=".$id."' class='alert-link'>riprova</a>.
                            </div>";

            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>