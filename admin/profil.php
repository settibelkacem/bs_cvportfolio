<?php require 'inc/init.inc.php'; 
 require 'inc/acces_admin.php'; ?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <?php
        //requête pour une seule info avec la condition de la variable $id_utilisateur
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    
    <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
	<?php require 'inc/head.php'; ?>
</head>
  <body class="text-center">
    
	  <div class="container-fluid  justify-content-md-center">
      <?php require 'inc/navigation.php'; ?>
		   
      
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><i class="fas fa-user-circle"></i> Profil :  <?php echo $ligne_utilisateur['pseudo']; ?></h1>
                <p class="lead">Gestion des données de mon CV.</p>
            </div>
        </div>
      <div class="container ">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="card" style="width:400px">
              <img class="card-img-top" src="img/<?php echo $ligne_utilisateur['photo']; ?>" alt="Mettre image">
              <div class="card-body">
                <h4 class="card-title"><?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom']; ?></h4>
                  <address class="card-text">
                    <?php echo $ligne_utilisateur['adresse'].'<br>'.$ligne_utilisateur['code_postal'].' '.$ligne_utilisateur['ville'].'<br><i>'.$ligne_utilisateur['email'].'</i><br>'.$ligne_utilisateur['tel']; ?>
                  </address>
                  <a href="#" class="btn btn-primary">Mon profil</a>
              </div>
            </div>
          </div>
        </div>
      </div>
        
        
        
    
    <?php

    require_once 'inc/bas.inc.php'; // footer et fermeture des balises

    

