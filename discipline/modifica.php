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
            <h1>Modifica Disciplina</h1>
            
            <?php

                include("../dati.php");

                $id = $_GET["idDisciplina"];

                $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");

                $sql = "SELECT * FROM discipline AS d 
                        INNER JOIN sports AS s ON s.idSport = d.idSport 
                        WHERE idDisciplina = ".$id."
                        ORDER BY disciplina";

                $sql1 = "SELECT * FROM sports
                        ORDER BY sport";

                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) === 0)
                    echo "  <div class='col-md-4 offset-md-4 alert alert-alert alert-dismissible fade show' role='alert'>
                                <strong>Nessuna disciplina trovata con l'id ".$id."!</strong><br>
                                Torna <a href='../' class='alert-link'>indietro</a>.
                            </div>";
                else{
                    $row = mysqli_fetch_array($query);
                    $body = "   <form class='col-md-4' action='modifica1.php' method='POST' enctype='multipart/form-data'>";
                    if($row['icona'] !== "NULL")
                        $body .= "  <image src='../static/disciplina/".$row['icona']."'>";
                    else
                        $body .= "  <image src='../static/disciplina/notfound.png'>";
                        
                    $body .= "      <input type='hidden' name='vecchiaIcona' value='".$row['icona']."'>
                                    <div class='form-group'>
                                        <label for='disciplina'>Modifica Disciplina</label>
                                        <input class='form-control' type='text' id='disciplina'
                                                name='disciplina' value='".$row['disciplina']."'>
                                    </div>";
                    
                    $body .= "      <div class='form-group'>
                                        <label for='sport'>Sport</label>
                                        <select class='form-control' id='sport' name='sport'>";
                    
                    $query1 = mysqli_query($conn, $sql1);
                    if($query1)
                        if (mysqli_num_rows($query1) !== 0)
                            while ($row1 = mysqli_fetch_array($query1))
                                if($row1["idSport"] === $row['idSport'])
                                    $body .= "  <option value='".$row1["idSport"]."' selected>".$row1["sport"]."</option>";
                                else
                                    $body .= "  <option value='".$row1["idSport"]."'>".$row1["sport"]."</option>";
                    $body .= "          </select>
                                    </div>";

                    $body .= "      <div class='form-group'>
                                        <label for='icona'>Modifica Icona Disciplina</label>
                                        <input type='file' name='icona' id='icona'>
                                    </div>
                                    <input type='hidden' name='idDisciplina' value='".$id."'>
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