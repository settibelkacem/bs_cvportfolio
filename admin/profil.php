<?php require 'inc/init.inc.php'; 
 
//1- redirection si l'internaute n'est pas connecté :
if(!internauteEstConnecte()) {  // si le membre n'est pas connecté il ne doit pas avoir accés à la page profil
    header('location:index.php');  // nous l'invitons à se connecter
    exite();

}

// 2- préparation du profil à afficher :
//debug($_SESSION);
extract($_SESSION['t_utilisateurs']);   // extrait tous les indices de l'array sous forme de variable auxquelles on affecte la valeur dans l'array. Exemple : $_SESSION['membre']['pseudo']  devient $pseudo = $_SESSION['membre']['pseudo'];


//-----------------------------------------------------------AFFICHAGE---------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
        //requête pour une seule info
    $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs ");
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



