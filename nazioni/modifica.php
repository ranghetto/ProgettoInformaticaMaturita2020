<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifica Nazione</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>
        <div class="container-fluid">
            <h1>Modifica Nazione</h1>
            
            <?php

                include("../dati.php");

                $id = $_GET["idNazione"];

                $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");

                $sql = "SELECT * FROM nazioni WHERE idNazione = ".$id;

                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) === 0)
                    echo "  <div class='alert alert-alert alert-dismissible fade show' role='alert'>
                                <strong>Nessuna nazione trovata con l'id ".$id."!</strong>
                                Torna <a href='../' class='alert-link'>indietro</a>.
                            </div>";
                else{
                    $row = mysqli_fetch_array($query);
                    $body = "   <form class='col-md-4' action='modifica1.php' method='POST' enctype='multipart/form-data'>";
                    if($row['icona'] !== "NULL")
                        $body .= "  <image src='../static/bandiere/".$row['icona']."'>";
                    else
                        $body .= "  <image src='../static/bandiere/notfound.png'>";
                        
                    $body .= "      <input type='hidden' name='vecchiaIcona' value='".$row['icona']."'>
                                    <div class='form-group'>
                                        <label for='nazione'>Modifica Nome</label>
                                        <input class='form-control' type='text' id='nazione'
                                                name='nazione' value='".$row['nazione']."'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='icona'>Modifica Icona Bandiera</label>
                                        <input type='file' name='icona' id='icona'>
                                    </div>
                                    <input type='hidden' name='idNazione' value='".$id."'>
                                    <input class='btn btn-primary' type='submit'
                                            name='submit' id='submit' value='Modifica'>
                                    <a class='btn btn-danger' href='./index.php'>Annulla</a>
                                </form>";
                    echo $body;
                }
            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>