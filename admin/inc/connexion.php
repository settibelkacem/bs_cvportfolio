<?php 
// fichier de connexion à la BDD
$host='localhost';//le chemin vers le serveur de données
$database='pantinportfolio';//le nom de la base de données
$user='root';//le nom d'utilisateur pour se connecter
$psw='';// mot de passe de l'utilisateur local (sur PC)
// $psw='root'; // mot de passe local (sur MAC)

$pdoCV = new PDO('mysql:host='.$host.';dbname='.$database,$user,$psw);
//$pdoCV est le nom de la variable pour la connexion à la BDDqui nous sert partout où l'on doit se servir de cette connexion
$pdoCV->exec("SET NAMES utf8");

?>      