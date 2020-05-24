<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Elimina Disciplina</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>
        <div class="container-fluid">
            <?php

                include("../dati.php");

                $id = $_GET['idDisciplina'];

                $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");

                $sql = "DELETE FROM discipline WHERE idDisciplina = ".$id;

                $query = mysqli_query($conn, $sql);

                if($query)
                    echo "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Disciplina eliminata con successo!</strong> Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarle tutte.
                            </div>";
                else
                    echo "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'eliminazione della disciplina!</strong>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./elimina.php?idDisciplina=".$id."' class='alert-link'>riprova</a>.
                            </div>";

            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>