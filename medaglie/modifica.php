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
            <h1>Modifica Medaglia</h1>
            
            <?php

                include("../dati.php");

                $id = $_GET["idMedaglia"];

                $conn = mysqli_connect($host, $user, $pwd, $schema)
                            or die("Impossibile connettersi al database.");

                $sql = "SELECT * FROM medaglie AS m
                            INNER JOIN nazioni AS n ON m.idNazione = n.idNazione 
                            INNER JOIN discipline AS d ON m.idDisciplina = d.idDisciplina 
                            INNER JOIN sports AS s ON d.idSport = s.idSport 
                        WHERE idMedaglia = ".$id;

                $sql1 = "SELECT * FROM nazioni
                        ORDER BY nazione";

                $sql2 = "SELECT * FROM discipline AS d
                            INNER JOIN sports AS s on d.idSport = s.idSport
                        ORDER BY sport, disciplina";

                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) === 0)
                    echo "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Nessuna medaglia trovata con l'id ".$id."!</strong><br>
                                Torna <a href='./index.php' class='alert-link'>indietro</a>.
                            </div>";
                else{
                    $row = mysqli_fetch_array($query);
                    $body = "   <form class='col-md-4' action='modifica1.php' method='POST'>";
                    
                    $body .= "      <div class='form-group'>
                                        <label for='sport'>Nazione</label>
                                        <select class='form-control' id='nazione' name='idNazione'>";
                    
                    $query1 = mysqli_query($conn, $sql1);
                    if($query1)
                        if (mysqli_num_rows($query1) !== 0)
                            while ($row1 = mysqli_fetch_array($query1))
                                if($row1["idNazione"] === $row['idNazione'])
                                    $body .= "  <option value='".$row1["idNazione"]."' selected>".$row1["nazione"]."</option>";
                                else
                                    $body .= "  <option value='".$row1["idNazione"]."'>".$row1["nazione"]."</option>";
                    $body .= "          </select>
                                    </div>";
                    
                                    $body .= "      <div class='form-group'>
                                    <label for='sport'>Sport - Disciplina</label>
                                    <select class='form-control' id='sport' name='idDisciplina'>";
                
                    $query2 = mysqli_query($conn, $sql2);
                    if($query2)
                        if (mysqli_num_rows($query2) !== 0)
                            while ($row2 = mysqli_fetch_array($query2))
                                if($row2["idDisciplina"] === $row['idDisciplina'])
                                    $body .= "  <option value='".$row2["idDisciplina"]."' selected>".$row2["sport"]." - ".$row2["disciplina"]."</option>";
                                else
                                    $body .= "  <option value='".$row2["idDisciplina"]."'>".$row2["sport"]." - ".$row2["disciplina"]."</option>";
                    $body .= "          </select>
                                    </div>";

                    $body .= "      <div class='form-group'>
                                        <label for='data'>Data </label><br>
                                        <input type='date' name='data' id='data' value='".$row["data"]."'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='medaglia'>Medaglia </label>
                                        <select class='form-control' id='medaglia' name='medaglia'>";
                    if($row['medaglia'] == 1)
                        $body .= "          <option value='1' selected>Oro</option>
                                            <option value='2'>Argento</option>
                                            <option value='3'>Bronzo</option>";
                    if($row['medaglia'] == 2)
                        $body .= "          <option value='1'>Oro</option>
                                            <option value='2'selected>Argento</option>
                                            <option value='3'>Bronzo</option>";
                    if($row['medaglia'] == 3)
                        $body .= "          <option value='1'>Oro</option>
                                            <option value='2'>Argento</option>
                                            <option value='3'selected>Bronzo</option>";
                    $body .=       "    </select>
                                    </div>
                                    <input type='hidden' name='idMedaglia' value='".$id."'>
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