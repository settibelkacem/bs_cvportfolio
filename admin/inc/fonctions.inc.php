<?php

//1/---------------------------fonction de debug------------------------------------

function debug($param) {
    echo '<pre>';
    print_r($param);
    echo '</pre>';
}


//2/--------------------------fonction membres--------------------------------------
// fonction date

// function validateDate ($date, $format = 'Y'){// $format = 'd-m-Y' permet de donner une valeur par défaut au paramètre $format si on ne lui pas d'argument lors de l'appel de la fonction
//     $d = DateTime::createFromFormat($format, $date); // Crée un objet date si la date est valide et qu'elle corrspond au format indiqué dans $format. Dans le cas contraire, retourne false (c'est- à - dir si la date n'est pas valide ou qu'elle ne correspond pas au format indiqué)

//     if ($d && $d->format($format)== $date){ // si $d n'est pas false (voir ci-dessus) et que l'objet dat $d est bien égale à la date $date, c'est qu'il n'y a pas eu d'extrapolation sur la date : exemple de 32/01/2015 qui devient 01/02/2015. Dans ce cas la date est validé . On retourne true.

//         return true;
//     }
//     else {

//         return false;
//     }
    
//  }

    // Fonction qui indique si l'internaute est connécté :
    function internauteEstConnecte() {
        if(isset($_SESSION['t_utilisateurs'])) {  // si la session "membre" existe, c'est que l'internaute est passé par la page de connexion et nous avons créé cet indice dans $_SESSION
            return true;
        } else {
            return false;
        }
        // OU :
       
        
    }

//3/ Fonctionqui indique si le membre est admin connecté :
function internauteEstConnecteEtAdmin() {
    if(internauteEstConnecte() && $_SESSION['t_utilisateurs']['statut'] == 1){ // si membre est connecté et que son statut dans la session vaut 1, il est admin connecté
            return true;
    }else {
        return false;
    }
    // OU :
    return (internauteEstConnecte() && $_SESSION['t_utilisateurs']['statut'] == 1);
}

//3/---------------------------------------------------------------------Fonction de Requêtte : ---------------------------------------------------------------------
function executeRequete($req, $param = array()) {   // cette fonction attend 2 valeurs : 1 ezquête SQL (obligatoire) et un array qui associe les marqueurs aux valeurs (non obligatoire car on a affecté au paramètre un array() vide par défaut)

    // Echappement des données reçues avec htmlspecialchars :
    if (!empty($param)) {  // si l'array $param n'est pas vide, je peux faire la boucle :

        foreach($param as $indice => $valeur) {
            $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES);  // ici , on échappe les valeurs de $param que l'on remet à leur place dans $param[$indice]
        }
    }

    global $pdo;   // permet d'avoir accès à la variable $pdo définie dans l'espace global (c'est-à-dire hors de cette fonction) au sein de cette fonction

    $result = $pdo->prepare($req); // on prépare la requête envoyée à notre fonction
    $result->execute($param);   /// on exécute la requête en lui donnant l'arrayprésent dans $param qui associe tous les marqueurs à leur valeur
    return $result;   // on retourne le résultat de la requête de SELECT


}// fin de function executeRequete($req, $param = array())
