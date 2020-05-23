<?php include("../dati.php"); ?>

<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Creazione Database <?php echo $schema ?></title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
    <?php include("../navbar.php") ?>
    <?php

        $conn = mysqli_connect($host, $user, $pwd, $schema)
                    or die("Errore di connessione al database.");

        $sql = "CREATE DATABASE ".$schema;

        $query = mysqli_query($conn, $sql);

        if($query)
            echo "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Database \"".$schema."\" creato correttamente!</strong> Torna alla <a href='".getURL("/")."' class='alert-link'>home</a>.
                    </div>";
        else
            echo "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Errore di creazione del database \"".$schema."\":</strong> Il database potrebbe essere presente.
                        Torna alla <a href='".getURL("/")."' class='alert-link'>home</a>.
                    </div>";

        mysqli_close($conn);

    ?>
    <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>