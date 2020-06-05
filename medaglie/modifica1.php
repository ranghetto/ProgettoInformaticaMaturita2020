<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifica Medaglia</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>    
        <div class="container-fluid">
            <?php

                include("../dati.php");

                $id = $_POST['idMedaglia'];

                // Controllo che l'id della nazione esista
                if( isset($_POST['idMedaglia']) && 
                        ( isset($_POST['data']) && $_POST['data']!="" ) && 
                        isset($_POST['idNazione']) && 
                        isset($_POST['idDisciplina']) && 
                        ( isset($_POST['medaglia']) && 
                            (   $_POST['medaglia']>=1 && 
                                $_POST['medaglia']<=3
                            )
                        )
                    ){
                    $data = $_POST['data'];
                    $medaglia = $_POST['medaglia'];
                    $idNazione = $_POST['idNazione'];
                    $idDisciplina = $_POST['idDisciplina'];

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                                or die("Impossibile connettersi al database.");
                    
                    $sql = "UPDATE medaglie SET medaglia = \"".$medaglia."\", idNazione = \"".$idNazione."\", idDisciplina = \"".$idDisciplina."\", data = \"".$data."\" WHERE idMedaglia = ".$id;

                    $query = mysqli_query($conn, $sql);

                    if($query)
                        echo "  <div class='col-md-4 offset-md-4 alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Medaglia modificata con successo!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarle tutte.
                                </div>";
                    else
                        echo "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nella modifica della medaglia!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a>
                                    oppure <a href='./modifica.php?idMedaglia=".$id."' class='alert-link'>riprova</a>.
                                </div>";
                } else
                    echo "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nella modifica della medaglia! I dati non possono essere vuoti.</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./modifica.php?idMedaglia=".$id."' class='alert-link'>riprova</a>.
                            </div>";

            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>