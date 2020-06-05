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
            <h1>Modifica Sport</h1>
            
            <?php

                include("../dati.php");

                $id = $_GET["idSport"];

                $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");

                $sql = "SELECT * FROM sports WHERE idSport = ".$id;

                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) === 0)
                    echo "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Nessuno sport trovato con l'id ".$id."!</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>.
                            </div>";
                else{
                    $row = mysqli_fetch_array($query);
                    echo "  <form class='col-md-4' action='modifica1.php' method='POST' enctype='multipart/form-data'>
                                <div class='form-group'>
                                    <label for='sport'>Modifica Sport</label>
                                    <input class='form-control' type='text' id='sport'
                                            name='sport' value='".$row['sport']."'>
                                </div>
                                <input type='hidden' name='idSport' value='".$id."'>
                                <input class='btn btn-primary' type='submit'
                                        name='submit' id='submit' value='Modifica'>
                                <a class='btn btn-danger' href='./index.php'>Annulla</a>
                            </form>";
                }
            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>