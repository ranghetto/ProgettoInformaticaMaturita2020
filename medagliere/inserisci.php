<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento Medaglia</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>

        <div class="container-fluid">

            <?php

                include("../dati.php");

                $conn = mysqli_connect($host, $user, $pwd, $schema)
                    or die("Impossibile connettersi al database.");

                if(isset($_POST['nazione']) && isset($_POST['disciplina']) && isset($_POST['medaglia']) && isset($_POST['data']) && 
                    $_POST['data']!="" && $_POST['medaglia']>=1 && $_POST['medaglia']<=3){

                    $idNazione = $_POST['nazione'];
                    $idDisciplina = $_POST['disciplina'];
                    $medaglia = $_POST['medaglia'];
                    $data = $_POST['data'];

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                                or die("Impossibile connettersi al database.");

                    $sql = "INSERT INTO medaglie VALUES (DEFAULT, \"".$data."\", \"".$medaglia."\", \"".$idNazione."\", \"".$idDisciplina."\")";

                    $query = mysqli_query($conn, $sql);

                    if($query)
                        echo "  <div class='col-md-4 offset-md-4 alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Medaglia inserita correttamente!</strong><br>
                                    Torna alla <a href='../' class='alert-link'>home</a> per visualizzarle tutte.
                                </div>";
                    else
                        echo "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nell'inserimento della medaglia!</strong><br>
                                    Torna alla <a href='../' class='alert-link'>home</a>
                                </div>";
                }else
                    echo "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'inserimento della medaglia! Il dati non possono essere vuoti.</strong><br>
                                Torna <a href='../index.php' class='alert-link'>indietro</a>.
                            </div>";

            ?>

        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>