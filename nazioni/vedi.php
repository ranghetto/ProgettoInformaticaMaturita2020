<?php
    include("../dati.php");

    $conn = mysqli_connect($host, $user, $pwd, $schema)
                or die("Impossibile connettersi al database.");

    $ordine = "ASC";
    if( isset($_GET["ordine"]) && $_GET["ordine"]==="DESC" )
        $ordine = "DESC";

    $cerca = "%%";
    if( isset($_GET["cerca"]) && $_GET["cerca"]!=="" )
        $cerca = "%".$_GET["cerca"]."%";

    $sql = "SELECT * FROM nazioni
            WHERE nazione LIKE \"".$cerca."\"
            ORDER BY nazione ".$ordine;

    $query = mysqli_query($conn, $sql);

    $body = "<div class='container-fluid'>";
    

    if($query){
        if (mysqli_num_rows($query) === 0){
            $body .= "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
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
                            <th>Bandiera</th>
                            <th class='vertical-align'>Nome";
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
                            <th>Azioni</th>
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
            $body .= "  <tr>";

            if($row['icona'] !== "NULL")
                $body .= "  <td class='align-middle'><image src='../static/bandiere/".$row['icona']."'></td>";
            else
                $body .= "  <td class='align-middle'><image src='../static/bandiere/notfound.png'></td>";

            $body .= "      <td class='align-middle'>".$row['nazione']."</td>
                            <td class='align-middle'>
                                <a class='btn btn-outline-primary' href='./modifica.php?idNazione=".$row["idNazione"]."'>Modifica</a>
                                <a class='btn btn-outline-danger' href='./elimina.php?idNazione=".$row["idNazione"]."'>Elimina</a>
                            </td>
                        </tr>";
        }

        $body .= "</table></div></div>";

    } else {
        $body .= "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Errore nella query: ".mysqli_error($conn)."</strong>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
    }
    

    echo $body;
?>

<!-- Modal Inserimento -->
<div class="modal fade" id="inserimento" tabindex="-1" role="dialog" aria-labelledby="InserimentoNuovaNazione" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inserisci Nuova Nazione</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="col-md-12" action="./inserisci.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" id="nome"
                                name="nome" placeholder="Nome">
                    </div>
                    
                    <div class="form-group">
                        <label for="icona">Icona Bandiera</label>
                        <input type="file" name="icona" id="icona">
                    </div>
                    
                    <input class="btn btn-success" type="submit"
                            name="submit" id="submit" value="Inserisci">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            </div>
        </div>
    </div>
</div>