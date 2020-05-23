<?php $tab = "medaglie" ?>
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
                        idMedaglia smallint auto_increment not null primary key,
                        idNazione smallint not null,
                        idDisciplina smallint not null,
                        dataM date not null,
                        medaglia tinyint not null,
                        foreign key (idNazione) references nazioni(idNazione),
                        foreign key (idDisciplina) references discipline(idDisciplina)
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