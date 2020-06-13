# Gestione Olimpiadi & Medagliere

## Per iniziare

### 2. Provalo in locale
Provare il sito in un ambiente locale è possibile seguendo questi semplici passaggi:
1. Scaricare tutti i file e copiarli nella directory dedicata nel proprio web server;
2. Creare nella root principale un file chiamato `dati.php` e incollare al suo interno il seguente codice:
    ```php
    <?php
        $host = "iltuohostname.it";
        $user = "username";
        $pwd = "password";
        $schema = "nome_del_database";
    ?>
    ```
    Modificare quindi **SOLO IL VALORE** delle variabili secondo le proprie esigenze.

    **ATTENZIONE**: inserisci il nome del database nella variabile `$schema` anche se non esiste ancora, vedremo nei prossimi punti come crearlo;
3. A questo punto avviare il web server ed accedere al sito tramite browser;
4. In caso di successo, dovreste trovarvi ad una pagina il cui messaggio è il seguente:

    ![Errore di connessione al database](./docs/images/error-db-connection.png)

    Non vi preoccupate, è normale dal momento che non abbiamo ancora creato il nostro database;
5. Seguite le indicazioni per inizializzarlo ed il sito sarà pronto per operare;