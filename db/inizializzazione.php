<?php include("../dati.php"); ?>

<?php
    require_once "../funzioni.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inizializzazione <?php echo $schema ?></title>
        <?php include("../static/bootstrapCSS.html") ?>
    </head>
    <body>
    <?php include("../navbar.php") ?>
    <?php

        $body = "";

        $conn = mysqli_connect($host, $user, $pwd);
        
        if($conn){

            mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS ".$schema);

            mysqli_query($conn, "USE ".$schema);
                    
            mysqli_query($conn, "CREATE TABLE IF NOT EXISTS sports(
                                    idSport int(11) auto_increment not null primary key,
                                    sport varchar(30) not null
                                )");

            mysqli_query($conn, "CREATE TABLE IF NOT EXISTS discipline(
                                    idDisciplina int(11) auto_increment not null primary key,
                                    disciplina varchar(30) not null,
                                    icona varchar(50),
                                    idSport int(11) not null,
                                    foreign key (idSport) references sports(idSport)
                                )");

            mysqli_query($conn, "CREATE TABLE IF NOT EXISTS nazioni(
                                    idNazione int(11) auto_increment not null primary key,
                                    nazione varchar(30) not null,
                                    icona varchar(50)
                                )");
                                
            mysqli_query($conn, "CREATE TABLE IF NOT EXISTS medaglie(
                                    idMedaglia int(11) auto_increment not null primary key,
                                    data date not null,
                                    medaglia tinyint not null,
                                    idNazione int(11) not null,
                                    idDisciplina int(11) not null,
                                    foreign key (idNazione) references nazioni(idNazione),
                                    foreign key (idDisciplina) references discipline(idDisciplina)
                                )");
            
            $body .= "  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Il database è stato inizializzato!</strong>
                                Torna alla <a href='../index.php' class='alert-link'>home</a>
                            </div>";
            
            mysqli_close($conn);
        }else
            $body .= "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Non è stato possibile stabilire una connessione al database.</strong>
                        </div>";

        echo $body;

    ?>
    <?php include("../static/bootstrapJS.html") ?>
    </body>
</html>