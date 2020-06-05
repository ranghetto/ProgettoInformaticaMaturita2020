<?php
    include("../dati.php");

    $conn = mysqli_connect($host, $user, $pwd, $schema);

    $ordine = "ASC";
    if( isset($_GET["ordine"]) && $_GET["ordine"]==="DESC" )
        $ordine = "DESC";

    $sql = "SELECT idMedaglia, n.icona, nazione, sport, disciplina, data, medaglia FROM medaglie AS m
            INNER JOIN nazioni AS n ON m.idNazione = n.idNazione
            INNER JOIN discipline AS d ON m.idDisciplina = d.idDisciplina
            INNER JOIN sports AS s ON d.idSport = s.idSport
            ORDER BY data ".$ordine;

    $body = "<div class='container-fluid'>";
    
    if($conn){

        $query = mysqli_query($conn, $sql);

        if($query){
            if (mysqli_num_rows($query) === 0){
                $body .= "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Nessuna medaglia trovata!</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
            }

            $body .= "
                <div class='row'>
                    <table class='table table-striped'>
                        <thead class='thead-light'>
                            <tr>
                                <th class='vertical-align text-center'>Bandiera</th>
                                <th class='text-center'>Nazione</th>
                                <th class='text-center'>Sport - Disciplina</th>
                                <th class='text-center'>Data</th>
                                <th class='text-center'>Medaglia</th>
                                <th class='text-center'>Azioni</th>
                            </tr>
                        </thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class='align-middle'>
                                <button type='button' class='btn btn-outline-success' data-toggle='modal' data-target='#inserimento'>
                                    Nuova Medaglia
                                </button>
                            </td>
                        </tr>";
            

            
            while ($row = mysqli_fetch_array($query)) {
                $body .= "  <tr>
                                <td class='align-middle'><image src='../static/bandiere/".$row['icona']."'></td>
                                <td class='align-middle'>".$row['nazione']."</td>
                                <td class='align-middle'>".$row['sport']." - ".$row['disciplina']."</td>
                                <td class='align-middle'>".$row['data']."</td>";

                if($row['medaglia'] == 1)
                    $body .= "  <td class='align-middle'>Oro <span style='color:#ffd700;'><i class='fas fa-medal'></i></span></td>";
                if($row['medaglia'] == 2)
                    $body .= "  <td class='align-middle'>Argento <span style='color:#c0c0c0;'><i class='fas fa-medal'></i></span></td>";
                if($row['medaglia'] == 3)
                    $body .= "  <td class='align-middle'>Bronzo <span style='color:#b08d57;'><i class='fas fa-medal'></i></span></td>";

                $body .= "      <td class='align-middle'>
                                    <a class='btn btn-outline-primary' href='./modifica.php?idMedaglia=".$row["idMedaglia"]."'>Modifica</a>
                                    <a class='btn btn-outline-danger' href='./elimina.php?idMedaglia=".$row["idMedaglia"]."'>Elimina</a>
                                </td>
                            </tr>";
            }

            $body .= "</table></div>";

        } else
            $body .= "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Errore nella query: ".mysqli_error($conn)."</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
    } else
        $body .= "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Non è stato possibile stabilire una connessione al database.</strong><br>
                            Clicca <a href='../db/inizializzazione.php' class='alert-link'>qui</a> per inizializzarlo.
                        </div>";

    echo $body.="</div>";
?>