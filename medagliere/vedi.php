<?php
    include("dati.php");

    $conn = mysqli_connect($host, $user, $pwd, $schema);
    $body = "<div class='container'>";
    
    $cerca = "%%";
    if( isset($_GET["cerca"]) && $_GET["cerca"]!=="" )
        $cerca = "%".$_GET["cerca"]."%";

    // Controllo che la connessione sia andata a buon fine
    if($conn){
        $sql = "SELECT n.icona, 
                    n.nazione, 
                    SUM(case when m.medaglia = 1 then 1 else 0 end) AS oro, 
                    SUM(case when m.medaglia = 2 then 1 else 0 end) AS argento, 
                    SUM(case when m.medaglia = 3 then 1 else 0 end) AS bronzo, 
                    COUNT(m.medaglia) as totale 
                FROM medaglie m 
                    RIGHT JOIN nazioni n 
                    ON m.idNazione = n.idNazione 
                GROUP BY n.nazione
                HAVING n.nazione LIKE \"".$cerca."\"
                ORDER BY oro DESC, argento DESC, bronzo DESC";
    
        $query = mysqli_query($conn, $sql);
        if($query){
            if (mysqli_num_rows($query) === 0){
                $body .= "  <div class='col-md-6 offset-md-3 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Nessuna corrispondenza nel database! Inserisci almeno una <a href='../nazioni'>nazione</a>!</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
            }else{
                $body .= "<div class='row justify-content-center' style='padding-top: 7px;'>
                            <form class='form-inline' action='./index.php'>
                                <div class='form-group mx-2 mb-2'>
                                    <input type='text' name='cerca' class='form-control' placeholder='Cerca Nazione' value='".trim($cerca, '%')."'>
                                </div>
                                <button type='submit' class='btn btn-outline-primary mb-2'><i class='fas fa-search'></i></button>&nbsp;
                                <a href='./index.php' class='btn btn-outline-danger mb-2'><i class='fas fa-times'></i></a>
                            </form>
                        </div>
                    </div>
                    <div class='row-fluid'>
                        <table class='table table-striped'>
                            <thead class='thead-light'>
                                <tr>
                                    <th class='text-center'>Bandiera</th>
                                    <th class='text-center'>Nazione</th>
                                    <th class='text-center'>Oro <span style='color:#ffd700;'><i class='fas fa-medal'></i></span></th>
                                    <th class='text-center'>Argento <span style='color:#c0c0c0;'><i class='fas fa-medal'></i></span></th>
                                    <th class='text-center'>Bronzo <span style='color:#b08d57;'><i class='fas fa-medal'></i></span></th>
                                    <th class='text-center'>Totale</th>
                                </tr>
                            </thead><tbody>";
                while ($row = mysqli_fetch_array($query))
                    $body .= "  <tr>
                                    <td class='align-middle'><image src=\"./static/bandiere/".$row['icona']."\"></td>
                                    <td class='align-middle'>".$row['nazione']."</td>
                                    <td class='align-middle'>".$row['oro']."</td>
                                    <td class='align-middle'>".$row['argento']."</td>
                                    <td class='align-middle'>".$row['bronzo']."</td>
                                    <td class='align-middle'>".$row['totale']."</td>
                                </tr>";

                $body .= "  </tbody></table>
                        </div>";
            }
        }else{
            $body .= "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Errore nella query: ".mysqli_error($conn)."</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
        }
    }else{
        $body .= "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Non è stato possibile stabilire una connessione al database.</strong><br>
                        Clicca <a href='../db/inizializzazione.php' class='alert-link'>qui</a> per inizializzarlo.
                    </div>";
    }
    

    echo $body .= "</div>";
?>

</div>