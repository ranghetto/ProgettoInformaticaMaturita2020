# 1. Requisiti
Lo sviluppo dell'applicazione è stato effettuato attraverso il web server [XAMPP](https://www.apachefriends.org/it/index.html), versione `7.4.5`, che comprende al suo interno:
* MariaDB `10.4.11` (fork di `MySQL` versione `5.6`);
* PHP `7.4.5`;

Il deploy dell'intero sito invece, è stato fatto su [Altervista](https://it.altervista.org), all'indirizzo  [rangomatteo.altervista.org](rangomatteo.altervista.org), server che contiene:
* MySQL `5.6`;
* PHP `7.3`;

Entrambe le versioni, sia per quanto riguarda `PHP`, sia per quanto riguarda `MySQL`/`MariaDB`, sono compatibili tra loro quindi, non c'è stato bisogno di effettuare modifiche nel passaggio dallo sviluppo al deploy. Il motore utilizzato è `InnoDB`, scelto per la caratteristica fondamentale di permettere la creazione delle `foreign keys`, che conferiscono la possibilità di creare una relazione logica tra due (o più) tabelle, in modo da rendere consistenti i dati (vedi [vincoli](#vincoli)).

Il caricamento dei file nel server di Altrvista è sempre stato effettuato attraverso il protocollo `FTP`.

## 1.1 Test in locale
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

    ![Errore di connessione al database](./images/error-db-connection.png)

    Non vi preoccupate, è normale dal momento che non abbiamo ancora creato il nostro database;
5. Seguite le indicazioni per inizializzarlo ed il sito sarà pronto per operare;

# 2. Il progetto
Creare un sito web per la gestione di un medagliere delle olimpiadi.

L'ambito del progetto potrebbe essere quello di un'azienda che gestisce le statistiche dei vincitori delle olimpiadi (solamente chi rientra nel podio) e magari di fornire, attraverso delle `API`, i dati a terzi parti.

## 2.1 Schema Entity Relationships (E/R)

![Schema Entity Relationships](./images/er.png)

La relazione che si crea tra `sports e discipline è di 1 a N` ( a uno sport corrispondono una o più discipline, ma non viceversa ).

La relazione che si crea tra `nazioni e discipline è N a N` ( ad una nazione corrispondono una o più discipline e viceversa )

## 2.2 Schema Logico

![Schema Logico](./images/logico.png)

## 2.3 Vincoli
Dallo schema logico possiamo vedere alcuni `vincoli di integrità referenziale` ( FK ) quali:
* Nazioni -> Medaglie
* Discipline -> Medaglie
* Sports -> Discipline

Questi permettono di assicurare la `consistenza` dei dati all'interno del database, non permettendo, ad esempio, l'eliminazione di un dato che è collegato (attravereso le chiavi primarie - esterne) ad un'altra tabella. (es. Non posso eliminare uno sport se questo ha delle discipline a lui collegate).

Inoltre vi si trova un `vincolo di dominio` nel campo `medaglia` della tabella `medaglie`: esso può assumere solamente valori numerici di tipo intero da 1 a 3 ( estremi compresi, ma è presente un controllo che impedisce l'inserimento di valori estranei a questo vincolo ).

L'univocità di ogni record è possibile grazie alle `chiavi primarie` presenti in ogni tabella ( PK ). Non è presente il controllo sui valori immessi durante l'inserimento e la modifica, per tanto bisogna fare attenzione durante queste due fasi.

## 2.4 I Linguaggi
Ho scelto `PHP` (Personal Home Page inizialmente, poi modificato in Hypertext Preprocessor), un linguaggio di scripting lato server interpretato, in quanto molto semplice ed adatto per lo sviluppo dell'intero progetto. 
Avendo un alto grado di portabilità infatti, esso è perfetto per quasi qualsiasi piattaforma, sia quando si parla di sistemi operativi, sia quando si parla di web server.

Inoltre sono presenti altri linguaggi come `CSS` (Cascading Style Sheets) e `JavaScript` (ECMA Script), entrambi utilizzati dal framework [Bootstrap](https://getbootstrap.com/), che è stato utile per realizzare l'interfaccia grafica.

Per interfacciarmi con il database ho utilizzato il linguaggio `SQL` (Structured Query Language), inserendo le istruzioni in apposite funzioni offerte da PHP.

## 2.5 Base di dati in linguaggio SQL
```sql
-- Creazione tabella `sports`
CREATE TABLE sports(
    idSport int(11) auto_increment not null primary key,
    sport varchar(30) not null
)

-- Creazione tabella `discipline`
CREATE TABLE discipline(
    idDisciplina int(11) auto_increment not null primary key,
    disciplina varchar(30) not null,
    icona varchar(50),
    idSport int(11) not null,
    foreign key (idSport) references sports(idSport)
)

-- Creazione tabella `nazioni`
CREATE TABLE nazioni(
    idNazione int(11) auto_increment not null primary key,
    nazione varchar(30) not null,
    icona varchar(50)
)

-- Creazione tabella `medaglie`
CREATE TABLE medaglie(
    idMedaglia int(11) auto_increment not null primary key,
    data date not null,
    medaglia tinyint not null,
    idNazione int(11) not null,
    idDisciplina int(11) not null,
    foreign key (idNazione) references nazioni(idNazione),
    foreign key (idDisciplina) references discipline(idDisciplina)
)
```
**P.S.** Nello script di inizializzazione del database, all'interno del codice, è stata inserita, successivamente ad ogni istruzione `CREATE TABLE`, l'istruzione `IF NOT EXISTS` per evitare errori spiacevoli.