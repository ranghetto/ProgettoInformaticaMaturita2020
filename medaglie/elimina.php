<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Elimina Medaglia</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>
        <div class="container-fluid">
            <?php

                include("../dati.php");

                $id = $_GET['idMedaglia'];

                $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");

                $sql = "DELETE FROM medaglie WHERE idMedaglia = ".$id;

                $query = mysqli_query($conn, $sql);

                if($query)
                    echo "  <div class='col-md-4 offset-md-4 alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Medaglia eliminata con successo!</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarle tutte.
                            </div>";
                else
                    echo "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'eliminazione della medaglia!</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./elimina.php?idMedaglia=".$id."' class='alert-link'>riprova</a>.
                            </div>";

            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>