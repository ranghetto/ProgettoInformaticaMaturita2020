<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento Disciplina</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>

        <div class="container-fluid">
            <?php

                include("../dati.php");
                
                if( isset($_POST['disciplina']) && isset($_POST['sport']) && $_POST['disciplina']!=""){

                    $nome = $_POST['disciplina'];
                    $sport = $_POST['sport'];

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");
                
                    $sql = "INSERT INTO discipline VALUES (DEFAULT,\"".$nome."\", \"NULL\", \"".$sport."\")";

                    if( file_exists($_FILES['icona']['tmp_name']) && is_uploaded_file($_FILES['icona']['tmp_name'])){

                        $file = caricaFile($_POST["submit"], $_FILES["icona"], "discipline");
                        if($file["caricamentoRiuscito"])
                            $sql = "INSERT INTO discipline VALUES (DEFAULT,\"".$nome."\", \"".$file["nomeIcona"]."\", \"".$sport."\")";
                        else 
                            echo $file["messaggio"];

                        
                    }

                    $query = mysqli_query($conn, $sql);
        
                    if($query)
                        echo "  <div class='col-md-4 offset-md-4 alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Disciplina inserita correttamente!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarle tutte.
                                </div>";
                    else 
                        echo "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nell'inserimento della disciplina!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a>.
                                </div>";
                } else
                    echo "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nell'inserimento della disciplina! Il dati non possono essere vuoti.</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>.
                            </div>";
            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>