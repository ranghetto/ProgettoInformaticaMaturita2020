<?php
//RESTITUSCE: URL della pagina $pagina. Viene recuperato da $_SERVER l'URL generale e concatenata la stringa corrispondendente alla pagina.
function getURL($pagina) {
    
    if(isset($_SERVER["HTTPS"])) {
        $url = "https://";
    } else {
        $url = 'http://';
    }

    $url .= $_SERVER["SERVER_NAME"];

    if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
        $url .= ":" . $_SERVER["SERVER_PORT"];
    }

    return $url . $pagina;
}

function caricaFile($submit, $fileDaCaricare){
    $cartella = "../static/bandiere/";
    
    $file = $cartella . basename($fileDaCaricare["name"]);
    $riuscito = "si";
    $tipoFile = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    
    $body = "";

    // Controlla se il file corrisponde ad una immagine
    if(isset($submit)) {
        $check = getimagesize($fileDaCaricare["tmp_name"]);
        if($check === false) {
            $body .= "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Il file inviato non corrisponde ad una immagine!</strong>
                            Torna <a href='./index.php' class='alert-link'>indietro</a>
                            oppure <a href='./inserisci.php' class='alert-link'>riprova</a>.
                        </div>";
            $riuscito = "no";
        }
    }

    // Controlla che il file non esista già
    if (file_exists($file)) {
        $body .= "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Il file specificato esiste già!</strong>
                        Torna <a href='./index.php' class='alert-link'>indietro</a>
                        oppure <a href='./inserisci.php' class='alert-link'>riprova</a>.
                    </div>";
        $riuscito = "no";
    }

    // Controllo la dimensione massima del file 5MB
    if ($fileDaCaricare["size"] > 5000000) {
        $body .= "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Il file è troppo grande!</strong>
                        Torna <a href='./index.php' class='alert-link'>indietro</a>
                        oppure <a href='./inserisci.php' class='alert-link'>riprova</a>.
                    </div>";
        $riuscito = "no";
    }

    // Controllo che il formato del file sia jpg, png, jpeg
    if($tipoFile != "jpg" && $tipoFile != "png" && $tipoFile != "jpeg") {
        $body .= "  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>L'estenzione del file non è supportata!</strong>
                        Torna <a href='./index.php' class='alert-link'>indietro</a>
                        oppure <a href='./inserisci.php' class='alert-link'>riprova</a>.
                    </div>";
        $riuscito = "no";
    }

    /* USO LA FUNZIONE time() PER RINOMINARE IL FILE IN MODO DA ASSICURARE L'UNIVOCITA' */
    // funzione time per assicurare l'univocità del nome del file
    $nuovoNome = time() . "." . $tipoFile;
    $nuovaPosizione = $cartella . $nuovoNome;

    // se "riuscito", allora il file viene caricato sul server
    if ($riuscito == "si") {
        if (!move_uploaded_file($fileDaCaricare["tmp_name"], $nuovaPosizione)) {
            $body .= "  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Si è verificato un errore nell'riuscito del file!</strong>
                        </div>";
        }
    }

    return array("caricamentoRiuscito"=>$riuscito, "messaggio"=>$body, "nomeIcona"=>$nuovoNome);
}

?>