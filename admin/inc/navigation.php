<!-- navigation principale -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<a class="navbar-brand" href="index.php"><i class="fas fa-briefcase"></i></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-end" id="navbarsExample08">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php"><i class="fas fa-home"></i> <?php echo $ligne_utilisateur['prenom']; ?> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profil.php"><i class="fas fa-user"></i></a>
          </li>
          <li class="nav-item text-nowrap">
            <a class="nav-link" href="messages.php"><i class="fa fa-envelope"></i></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mes contenus</a>
            <div class="dropdown-menu" aria-labelledby="dropdown08">
              <a class="dropdown-item" href="competences.php"><i class="fas fa-book-reader"></i> - Compétences</a>
              <a class="dropdown-item" href="loisirs.php"><i class="fas fa-table-tennis"></i> - Loisirs</a>
              <a class="dropdown-item" href="formations.php"><i class="fas fa-school"></i> - Formations</a>
              <a class="dropdown-item" href="experiences.php"><i class="fas fa-building"></i> - Experiences</a>
              <a class="dropdown-item" href="reseaux.php"><i class="fas fa-globe"></i> - Reseaux</a>
              <a class="dropdown-item" href="messages.php"><i class="fas fa-envelope"></i> - Messages</a>
              <a class="dropdown-item" href="realisations.php"><i class="fas fa-clipboard"></i> - Réalisation</a>
              <a class="dropdown-item" href="titres.php"><i class="fas fa-heading"></i> - Titres </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/index.php?quitter=oui" title="<?php echo $ligne_utilisateur['prenom']; ?> déconnectez-vous !"><i class="fas fa-door-open"></i></a>
          </li>
        </ul>
      </div>
    </nav><!-- fin navigation -->



    