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
<body>
<?php require 'inc/navigation.php'; ?>

<h1 class="mt-4">Profile</h1>

<h2>Bonjour <strong><?php echo $prenom; ?></strong></h2>

<?php 
if (internauteEstConnecteEtAdmin()) echo '<p>Vous êtes un administrateur.</p>';
?>
<hr>

<h3>Voici vos formations de profil</h3>

<p>Votre email : <?php echo $email; ?></p>
<p>Votre adresse : <?php echo $adresse; ?></p>
<p>Votre ville: <?php echo $ville; ?></p>
<p>Votre code postal : <?php echo $code_postal; ?></p>



<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises










