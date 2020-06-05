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

            <li class="nav-item">
                <?php echo "<a class=\"nav-link\" href=\"".getURL("/medaglie")."\">Medaglie</a>" ?>
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