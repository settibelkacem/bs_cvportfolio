<?php
session_start();// à mettre dans toutes les pages de l'admin 
// define('RACINE_SITE', '/bs_cvportfolio/');

if (isset($_SESSION['connexion_admin'])) {// si on est connecté on récupère les variables de session

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $email = $_SESSION['email'];
    $mdp = $_SESSION['mdp'];
    $nom = $_SESSION['nom'];

    // echo $id_utilisateur;
} else {// si on n'est pas connecté on ne peut pas accéder à l'admin
    header('location:../authentification.php');
}
//pour vider les variables de session on destroy !
if (isset($_GET['quitter'])) {//on récupère le terme quiiter en GET

    $_SESSION['connexion_admin'] = '';
    $_SESSION['id_utilisateur'] = '';
    $_SESSION['email'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['mdp'] = '';

    unset($_SESSION['connexion_admin']);//unset détruit la variable connexion_admin
    session_destroy();//on détruit la session

    header('location:../authentification.php');
}

?>      