# Gestione Olimpiadi & Medagliere

## Obiettivo
Creare un sito web per la gestione di un medagliere delle ultime olimpiadi. 

Creare tutte le pagine web necessarie alla gestione delle varie tabelle.
In particolare, la pagina di inserimento dei dati, relativi alle medaglie, dovrà mostrare un menù a discesa con la lista dei paesi partecipanti, la disciplina e un menù con il tipo di medaglia (oro, argento oppure bronzo). Ogni volta che si selezioneranno un paese, una disciplina e una medaglia, quest'ultima verrà assegnata. 

Prevedere anche una pagina di riepilogo del medagliere, con i paesi ordinati per quantità di medaglie con gli stessi criteri delle Olimpiadi.

## Prima di iniziare

### 1. Leggi la [documentazione](https://ranghetto.github.io/ProgettoInformaticaMaturita2020);

### 2. Il progetto ha bisogno di un file `PHP` all'interno della root principale chiamato `dati.php`:
```php
<?php
    $host = "iltuohostname.it";
    $user = "username";
    $pwd = "password";
    $schema = "nome_del_database";
?>
```
modificalo secondo le tue esigenze;