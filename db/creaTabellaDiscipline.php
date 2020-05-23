<?php $tab = "discipline" ?>
<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Creazione Tabella "<?php echo $tab ?>"</title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
        <?php include("../navbar.php") ?>
    <?php

        include("../dati.php");

        $conn = mysqli_connect($host, $user, $pwd, $schema)
                    or die("Errore di connessione al database.");

        $sql = "CREATE TABLE ".$tab."(
                    idDisciplina smallint auto_increment not null primary key,
                    nome varchar(30) not null
                )";

        $query = mysqli_query($conn, $sql);

        if($query)
            echo "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Tabella ".$tab." creata correttamente!</strong> Torna alla <a href='".getURL("/")."' class='alert-link'>home</a>.
                    </div>";
        else
            echo "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Errore di creazione della tabella ".$tab.":</strong> La tabella potrebbe essere presente.
                        Torna alla <a href='".getURL("/")."' class='alert-link'>home</a>.
                    </div>";

        mysqli_close($conn);

    ?>
    <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>