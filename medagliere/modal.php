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
                <form class="col-md-12" action="./medagliere/inserisci.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="nazione">Nazione </label>
                        <select class="form-control" id="nazione" name="nazione">
                            <?php
                                $sql = "SELECT * FROM nazioni
                                            ORDER BY nazione";

                                $query = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($query) !== 0)
                                    while ($row = mysqli_fetch_array($query))
                                        echo "<option value=".$row['idNazione'].">".$row['nazione']."</option>";
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="disciplina">Disciplina </label>
                        <select class="form-control" id="disciplina" name="disciplina">
                            <?php
                            $sql = "SELECT * FROM discipline
                                        ORDER BY disciplina";

                            $query = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($query) !== 0)
                                while ($row = mysqli_fetch_array($query))
                                    echo "<option value=".$row['idDisciplina'].">".$row['disciplina']."</option>";
                            ?>
                        </select>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            </div>
        </div>
    </div>
</div>