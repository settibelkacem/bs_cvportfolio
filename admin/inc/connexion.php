<?php 
// fichier de connexion à la BDD
$host='localhost';//le chemin vers le serveur de données
$database='sb_cvportfolio';//le nom de la base de données
$user='root';//le nom d'utilisateur pour se connecter
$psw='';// mot de passe de l'utilisateur local (sur PC)
// $psw='root'; // mot de passe local (sur MAC)

$pdoCV = new PDO('mysql:host='.$host.';dbname='.$database,$user,$psw);
//$pdoCV est le nom de la variable pour la connexion à la BDDqui nous sert partout où l'on doit se servir de cette connexion
$pdoCV->exec("SET NAMES utf8");



session_start();// à mettre dans toutes les pages de l'admin 

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