<?php
    include("../dati.php");

    $conn = mysqli_connect($host, $user, $pwd, $schema);

    $ordine = "ASC";
    if( isset($_GET["ordine"]) && $_GET["ordine"]==="DESC" )
        $ordine = "DESC";

    $cerca = "%%";
    if( isset($_GET["cerca"]) && $_GET["cerca"]!=="" )
        $cerca = "%".$_GET["cerca"]."%";

    $sql = "SELECT * FROM nazioni
            WHERE nazione LIKE \"".$cerca."\"
            ORDER BY nazione ".$ordine;

    $body = "<div class='container-fluid'>";
    
    if($conn){

        $query = mysqli_query($conn, $sql);

        if($query){
            if (mysqli_num_rows($query) === 0){
                $body .= "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Nessuna nazione trovata!</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
            }

            $body .= "
                <div class='row justify-content-center' style='padding-top: 7px;'>
                    <form class='form-inline' action='./index.php'>
                        <div class='form-group mx-2 mb-2'>
                            <input type='text' name='cerca' class='form-control' placeholder='Cerca Nazione' value='".trim($cerca, '%')."'>
                        </div>
                        <button type='submit' class='btn btn-outline-primary mb-2'><i class='fas fa-search'></i></button>&nbsp;
                        <a href='./index.php?ordine=".$ordine."' class='btn btn-outline-danger mb-2'><i class='fas fa-times'></i></a>
                    </form>
                </div>
                <div class='row'>
                    <table class='table table-striped'>
                        <thead class='thead-light'>
                            <tr>
                                <th class='text-center'>Bandiera</th>
                                <th class='vertical-align text-center'>Nazione";
            if($ordine === "ASC")
                $body .= "          <a href='./index.php?ordine=ASC&cerca=".trim($cerca, '%')."'><i class='fas fa-sort-alpha-down'></i></a>
                                    <a href='./index.php?ordine=DESC&cerca=".trim($cerca, '%')."'>
                                        <span style='color: Grey;'>
                                            <i class='fas fa-sort-alpha-up'></i>
                                        </span>
                                    </a>";
            else
                $body .= "          <a href='./index.php?ordine=ASC&cerca=".trim($cerca, '%')."'>
                                        <span style='color: Grey;'>
                                            <i class='fas fa-sort-alpha-down'></i>
                                        </span>
                                    </a>
                                    <a href='./index.php?ordine=DESC&cerca=".trim($cerca, '%')."'><i class='fas fa-sort-alpha-up'></i></a>";
            $body .= "          </th>
                                <th class='text-center'>Azioni</th>
                            </tr>
                        </thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class='align-middle'>
                                <button type='button' class='btn btn-outline-success' data-toggle='modal' data-target='#inserimento'>
                                    Nuova Nazione
                                </button>
                            </td>
                        </tr>";
            
            while ($row = mysqli_fetch_array($query)) {
                $body .= "  <tr>
                                <td class='align-middle'><image src='../static/bandiere/".$row['icona']."'></td>
                                <td class='align-middle'>".$row['nazione']."</td>
                                <td class='align-middle'>
                                    <a class='btn btn-outline-primary' href='./modifica.php?idNazione=".$row["idNazione"]."'>Modifica</a>
                                    <a class='btn btn-outline-danger' href='./elimina.php?idNazione=".$row["idNazione"]."'>Elimina</a>
                                </td>
                            </tr>";
            }

            $body .= "</table></div></div>";

        } else {
            $body .= "  <div class='col-md-4 offset-md-4 alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Errore nella query: ".mysqli_error($conn)."</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
        }
    } else
        $body .= "  <div class='col-md-4 offset-md-4 alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Non è stato possibile stabilire una connessione al database.</strong><br>
                            Clicca <a href='../db/inizializzazione.php' class='alert-link'>qui</a> per inizializzarlo.
                        </div>";
    
    echo $body;
?>