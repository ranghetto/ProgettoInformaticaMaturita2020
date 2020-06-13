<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Discipline ~ Olimpiadi</title>
        <?php include("../static/bootstrapCSS.html"); ?>
    </head>
    <body>
        <?php include("../navbar.php"); ?>

        <?php include("vedi.php"); ?>

        <!-- Modal Inserimento -->
        <div class="modal fade" id="inserimento" tabindex="-1" role="dialog" aria-labelledby="InserimentoNuovaDisciplina" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Inserisci Nuova Disciplina</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php 
                            $sql = "SELECT * FROM sports
                                    ORDER BY sport";
                
                            $query = mysqli_query($conn, $sql);

                            $body = "";

                            if($query)
                                if (mysqli_num_rows($query) !== 0){
                                    $body.= '<form class="col-md-12" action="./inserisci.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="sport">Sport</label>
                                                    <select class="form-control" id="sport" name="sport">';

                                    while ($row = mysqli_fetch_array($query))
                                        $body.= "       <option value='".$row["idSport"]."'>".$row["sport"]."</option>";

                                    $body.='        </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="disciplina">Disciplina</label>
                                                    <input class="form-control" type="text" id="disciplina"
                                                            name="disciplina" placeholder="Disciplina">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="icona">Icona Disciplina</label>
                                                    <input type="file" name="icona" id="icona">
                                                </div>
                                                
                                                <input class="btn btn-success" type="submit"
                                                        name="submit" id="submit" value="Inserisci">
                                            </form>';
                                }else
                                    $body.='<div class="alert alert-danger" role="alert">
                                                Prima di inserire una disciplina devi <a href="../sport/index.php" class="alert-link">inserire uno sport</a>!
                                            </div>';
                            else
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

        <?php include("../static/bootstrapJS.html"); ?>
    </body>
</html>