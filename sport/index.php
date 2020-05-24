<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sport ~ Olimpiadi</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>

        <?php include("vedi.php") ?>

        <!-- Modal Inserimento -->
        <div class="modal fade" id="inserimento" tabindex="-1" role="dialog" aria-labelledby="InserimentoNuovoSport" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Inserisci Nuovo Sport</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="col-md-12" action="./inserisci.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="sport">Sport</label>
                                <input class="form-control" type="text" id="sport"
                                        name="sport" placeholder="Sport">
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

        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>