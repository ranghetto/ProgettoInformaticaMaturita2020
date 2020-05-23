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
            <?php

                include("../dati.php");

                // Controllo che l'id della nazione esista
                if( isset($_POST['idNazione']) || ( isset($_POST['nome']) && $_POST['nome']!="" ) ){
                    $id = $_POST['idNazione'];
                    $nome = $_POST['nome'];
                    $vecchiaIcona = $_POST['vecchiaIcona'];

                    $conn = mysqli_connect($host, $user, $pwd, $schema)
                                or die("Impossibile connettersi al database.");
                    
                    $sql = "UPDATE nazioni SET nazione = \"".$nome."\" WHERE idNazione = ".$id;

                    if( file_exists($_FILES['icona']['tmp_name']) && is_uploaded_file($_FILES['icona']['tmp_name'])){

                        $file = caricaFile($_POST["submit"], $_FILES["icona"]);
                        if($file["caricamentoRiuscito"]){
                            $sql = "UPDATE nazioni SET nazione = \"".$nome."\", icona = \"".$file["nomeIcona"]."\" WHERE idNazione = ".$id;
                            //elimino la vecchia immagine se il caricamento di quella nuova è avvenuto con successo
                            if($vecchiaIcona != "NULL")
                                unlink("../static/bandiere/".$vecchiaIcona);
                        } else 
                            echo $file["messaggio"];
                    }

                    $query = mysqli_query($conn, $sql);

                    if($query)
                        echo "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Nazione modificata con successo!</strong> Torna <a href='./index.php' class='alert-link'>indietro</a> per visualizzarle tutte.
                                </div>";
                    else
                        echo "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Errore nella modifica della nazione!</strong>
                                    Torna <a href='./index.php' class='alert-link'>indietro</a>
                                    oppure <a href='./modifica.php?idNazione=".$id."' class='alert-link'>riprova</a>.
                                </div>";
                } else
                    echo "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nella modifica della nazione! I dati non possono essere vuoti.</strong>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>
                                oppure <a href='./modifica.php?idNazione=".$id."' class='alert-link'>riprova</a>.
                            </div>";

            ?>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>