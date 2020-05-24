<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php echo "<a class=\"navbar-brand\" href=\"/\">Olimpiadi</a>" ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <?php echo "<a class=\"nav-link\" href=\"/\">Home</a>" ?>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Operazioni DB
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php echo "<a class=\"dropdown-item\" href=\"".getURL("/db/creaDatabase.php")."\">Crea database</a>" ?>
                    <?php echo "<a class=\"dropdown-item\" href=\"".getURL("/db/creaTabellaNazioni.php")."\">Crea tabella \"nazioni\"</a>" ?>
                    <?php echo "<a class=\"dropdown-item\" href=\"".getURL("/db/creaTabellaDiscipline.php")."\">Crea tabella \"discipline\"</a>" ?>
                    <?php echo "<a class=\"dropdown-item\" href=\"".getURL("/db/creaTabellaMedaglie.php")."\">Crea tabella \"medaglie\"</a>" ?>
                </div>
            </li>

            <li class="nav-item">
                <?php echo "<a class=\"nav-link\" href=\"".getURL("/nazioni")."\">Nazioni</a>" ?>
            </li>

            <li class="nav-item">
                <?php echo "<a class=\"nav-link\" href=\"".getURL("/sport")."\">Sport</a>" ?>
            </li>

            <li class="nav-item">
                <?php echo "<a class=\"nav-link\" href=\"".getURL("/discipline")."\">Discipline</a>" ?>
            </li>
        </ul>
    </div>
</nav>