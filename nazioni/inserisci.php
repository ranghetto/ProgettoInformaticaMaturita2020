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
                
                $nome = $_POST['nazione'];
                
                if( isset($_POST['nazione']) && $_POST['nazione']!="" ){

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");
                
                    $sql = "INSERT INTO nazioni VALUES (DEFAULT,\"".$nome."\", \"NULL\")";

                    if( file_exists($_FILES['icona']['tmp_name']) && is_uploaded_file($_FILES['icona']['tmp_name'])){

                        $file = caricaFile($_POST["submit"], $_FILES["icona"], "bandiere");
                        if($file["caricamentoRiuscito"])
                            $sql = "INSERT INTO nazioni VALUES (DEFAULT,\"".$nome."\", \"".$file["nomeIcona"]."\")";
                        else 
                            echo $file["messaggio"];

                        
                    }

                    $query = mysqli_query($conn, $sql);
        
                    if($query)
                        echo "  <div class='col-md-4 offset-md-4 alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Nazione inserita correttamente!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarle tutte.
                                </div>";
                    else 
                        echo "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nell'inserimento della nazione!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a>.
                                </div>";
                } else
                    echo "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'inserimento della nazione! Il nome non può essere vuoto.</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>.
                            </div>";
            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>