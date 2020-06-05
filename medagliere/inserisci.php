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

                $idNazione = $_POST['nazione'];
                $idDisciplina = $_POST['disciplina'];
                $medaglia = $_POST['medaglia'];
                $data = $_POST['data'];

                if(isset($_POST['nazione']) && isset($_POST['disciplina']) && isset($_POST['medaglia']) && isset($_POST['data']) && 
                    $_POST['data']!="" && $_POST['medaglia']>=1 && $_POST['medaglia']<=3){

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                                or die("Impossibile connettersi al database.");

                    $sql = "INSERT INTO medaglie VALUES (DEFAULT, \"".$idNazione."\", \"".$idDisciplina."\", \"".$data."\", \"".$medaglia."\")";

                    $query = mysqli_query($conn, $sql);

                    if($query)
                        echo "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Medaglia inserita correttamente!</strong> Torna alla <a href='../' class='alert-link'>home</a> per visualizzarle tutte.
                                </div>";
                    else
                        echo "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nell'inserimento della medaglia!</strong>
                                    Torna alla <a href='../' class='alert-link'>home</a>
                                </div>";
                }else
                    echo "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'inserimento della disciplina! Il dati non possono essere vuoti.</strong>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./inserisci.php' class='alert-link'>riprova</a>.
                            </div>";

            ?>

        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>