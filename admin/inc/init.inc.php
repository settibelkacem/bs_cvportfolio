<?php
/*Ce fichier sera inclus dans TOUS les scripts (hors inc eux mêmes) pour initialiser les éléments suivant :
-connexion à la BDD
- créer ou ouvrir une session
- définir le chemin absolu du site (comme dans wordpress)
-inclure le fichier fonctions.inc.php à la fin de ce fichier pour l'embarquer dans tous les scripts.
 */ 

// -connextion à la BDD :
$host = 'localhost';//le chemin vers le serveur de données  
$database = 'sb_cvportfolio';//le nom de la base de données
$user = 'root';//le nom d'utilisateur pour se connecter
$psw = '';// mot de passe de l'utilisateur local (sur PC)
// $psw='root'; // mot de passe local (sur MAC)

$pdoCV = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $psw);
//$pdoCV est le nom de la variable pour la connexion à la BDDqui nous sert partout où l'on doit se servir de cette connexion
$pdoCV->exec("SET NAMES utf8");


//- définir le chemin absolu du site (comme dans wordpress) :
define('RACINE_SITE', '/setti_portfolio/');  // cette constante servira à créer les chemins absolus utilisés dans haut.inc.php car ce fichier sera inclus dans des scripts qui se situent dans des dossiers différents du site. On ne peut donc pas faire de chemin relatif dans ce fichier.

// Variables d'affichage :
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';

// inclusion du fichier fonction.inc.php :
require_once('fonctions.inc.php');
