<!-- Modal Inserimento -->
<div class="modal fade" id="inserimento" tabindex="-1" role="dialog" aria-labelledby="InserimentoNuovaMedaglia" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inserisci Nuova Medaglia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                    $body = "";
                    
                    $sql = "SELECT * FROM nazioni
                                ORDER BY nazione";

                    $sql1 = "SELECT idDisciplina, sport, disciplina FROM discipline AS d 
                                INNER JOIN sports AS s on d.idSport = s.idSport
                            ORDER BY sport, disciplina";


                    $query = mysqli_query($conn, $sql);
                    $query1 = mysqli_query($conn, $sql1);

                    if($query && $query1){
                        if(mysqli_num_rows($query) === 0)
                            $body.='<div class="alert alert-danger" role="alert">
                                        Prima di inserire una medaglia devi <a href="../nazioni/index.php" class="alert-link">inserire una nazione</a>!
                                    </div>';

                        if(mysqli_num_rows($query1) === 0)
                            $body.='<div class="alert alert-danger" role="alert">
                                        Prima di inserire una medaglia devi <a href="../discipline/index.php" class="alert-link">inserire una disciplina</a>!
                                    </div>';

                        if(mysqli_num_rows($query) !== 0 && mysqli_num_rows($query1) !== 0){
                            $body.='<form class="col-md-12" action="./medagliere/inserisci.php" method="POST" enctype="multipart/form-data">
                    
                                        <div class="form-group">
                                            <label for="nazione">Nazione </label>
                                            <select class="form-control" id="nazione" name="nazione">';

                            while ($row = mysqli_fetch_array($query))
                                $body.="        <option value=".$row['idNazione'].">".$row['nazione']."</option>";
                                                
                            $body.='        </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="disciplina">Sport - Disciplina </label>
                                            <select class="form-control" id="disciplina" name="disciplina">';
                            while ($row1 = mysqli_fetch_array($query1))
                                $body.="        <option value=".$row1['idDisciplina'].">".$row1['sport']." - ".$row1['disciplina']."</option>";

                            $body.='        </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="data">Data </label>
                                            <input type="date" class="form-control" id="data" name="data">
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="medaglia">Medaglia </label>
                                            <select class="form-control" id="medaglia" name="medaglia">
                                                <option value="1">Oro</option>
                                                <option value="2">Argento</option>
                                                <option value="3">Bronzo</option>
                                            </select>
                                        </div>
                                        
                                        <input class="btn btn-success" type="submit"
                                                name="submit" id="submit" value="Inserisci">
                                    </form>';
                        }
                    }else
                        $body.='<div class="alert alert-danger" role="alert">
                                    Errore nel recupero dei dati.
                                </div>';

                    echo $body;
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            </div>
        </div>
    </div>
</div>