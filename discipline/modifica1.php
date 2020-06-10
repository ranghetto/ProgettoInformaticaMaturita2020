<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifica Disciplina</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>    
        <div class="container-fluid">
            <?php

                include("../dati.php");

                // Controllo che l'id della nazione esista
                if( isset($_POST['idDisciplina']) && ( isset($_POST['disciplina']) && $_POST['disciplina']!="" ) && isset($_POST['sport']) ){
                    $id = $_POST['idDisciplina'];
                    $nome = $_POST['disciplina'];
                    $sport = $_POST['sport'];
                    $vecchiaIcona = $_POST['vecchiaIcona'];

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                                or die("Impossibile connettersi al database.");
                    
                    $sql = "UPDATE discipline SET disciplina = \"".$nome."\", idSport = \"".$sport."\" WHERE idDisciplina = ".$id;

                    if( file_exists($_FILES['icona']['tmp_name']) && is_uploaded_file($_FILES['icona']['tmp_name'])){

                        $file = caricaFile($_POST["submit"], $_FILES["icona"], "discipline");
                        if($file["caricamentoRiuscito"]){
                            $sql = "UPDATE discipline SET disciplina = \"".$nome."\", idSport = \"".$sport."\", icona = \"".$file["nomeIcona"]."\" WHERE idDisciplina = ".$id;
                            //elimino la vecchia immagine se il caricamento di quella nuova è avvenuto con successo
                            if($vecchiaIcona != "NULL")
                                unlink("../static/discipline/".$vecchiaIcona);
                        } else 
                            echo $file["messaggio"];
                    }

                    $query = mysqli_query($conn, $sql);

                    if($query)
                        echo "  <div class='col-md-4 offset-md-4 alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Disciplina modificata con successo!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarle tutte.
                                </div>";
                    else
                        echo "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nella modifica della disciplina!</strong><br>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a>
                                    oppure <a href='./modifica.php?idDisciplina=".$id."' class='alert-link'>riprova</a>.
                                </div>";
                } else
                    echo "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nella modifica della disciplina! I dati non possono essere vuoti.</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./modifica.php?idDisciplina=".$id."' class='alert-link'>riprova</a>.
                            </div>";

            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>