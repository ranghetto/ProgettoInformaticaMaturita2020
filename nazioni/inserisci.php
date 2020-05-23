<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento Nazione</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>

        <div class="container-fluid">
            <h1>Inserisci Nuova Nazione</h1>
            <form class="col-md-4" action="inserisci1.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input class="form-control" type="text" id="nome"
                            name="nome" placeholder="Nome">
                </div>
                
                <div class="form-group">
                    <label for="icona">Icona Bandiera</label>
                    <input type="file" name="icona" id="icona">
                </div>
                
                <input class="btn btn-primary" type="submit"
                        name="submit" id="submit" value="Invia">
                <a class="btn btn-secondary" href="./index.php">Annulla</a>
            </form>
        </div>
        <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>