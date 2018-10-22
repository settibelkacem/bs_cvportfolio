<!-- navigation principale -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<a class="navbar-brand" href="index.php"><i class="fas fa-briefcase"></i></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-end" id="navbarsExample08">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Accueil <?php echo $ligne_utilisateur['prenom']; ?> <span class="sr-only">(current)</span></a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="../admin/index.php?quitter=oui" title="<?php echo $ligne_utilisateur['prenom']; ?> déconnectez-vous !"><i class="fas fa-sign-out-alt"></i></a>
          </li>
        </ul>
      </div>
    </nav><!-- fin navigation -->



    