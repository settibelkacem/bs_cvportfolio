<?php require 'inc/init.inc.php'; 
    require 'inc/acces_admin.php'; 

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'pseudos') {
        $ordre = ' ORDER BY pseudo';
    }

    if ($_GET['ordre'] == 'asc') {
        $ordre .= ' ASC';
    } elseif ($_GET['ordre'] == 'desc') {
        $ordre .= ' DESC';
    }
}

// insertion d'un élément dans la base 
if (isset($_POST['pseudo'])) {//si on a un utilisateur

    if ($_POST['pseudo'] != '' && $_POST['mdp'] != '' && $_POST['prenom'] != '' && $_POST['nom'] != '' && $_POST['email'] != '' && $_POST['civilite'] != '' && $_POST['ville'] != '' && $_POST['code_postal'] != '' && $_POST['adresse'] != '' && $_POST['tel'] != '' && $_POST['age'] != '' && $_POST['anniversaire'] != '' && $_POST['genre'] != '' && $_POST['pays'] != '' && $_POST['commentaire'] != '') {

        $pseudo = addslashes($_POST['pseudo']);
        $mdp = addslashes($_POST['mdp']);
        $prenom = addslashes($_POST['prenom']);
        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $civilite = addslashes($_POST['civilite']);
        $ville = addslashes($_POST['ville']);
        $code_postal = addslashes($_POST['code_postal']);
        $adresse = addslashes($_POST['adresse']);
        $tel = addslashes($_POST['tel']);
        $age = addslashes($_POST['age']);
        $anniversaire = addslashes($_POST['anniversaire']);
        $genre = addslashes($_POST['genre']);
        $pays = addslashes($_POST['pays']);
        $commentaire = addslashes($_POST['commentaire']);
        
        
        $pdoCV->exec(" INSERT INTO t_utilisateurs VALUES (NULL, '$pseudo', '$mdp', '$prenom', '$nom', '$email', '$civilite', '$ville', '$code_postal', '$adresse', '$tel', '$age', '$anniversaire', '$genre', '$pays', '$commentaire', '1') ");

        header("location: ../admin/profil.php");
        exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if (isset($_GET['id_utilisateur'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_utilisateur'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_utilisateur WHERE id_utilisateur = '$efface' ";//delete de la base

    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/profil.php");
}//ferme le if isset pour la suppression
//-------------------AFFICHAGE------------------------------
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
      //requête pour une seule info avec la condition de la variable $id_utilisateur
      $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='$id_utilisateur' ");
      $ligne_utilisateur = $sql->fetch();
    ?>
    
    <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
    <?php require 'inc/head.php'; ?>
  </head>

  <body class="text-center">
    
    <div class="container-fluid">
        <?php require 'inc/navigation.php'; ?>
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4"><i class="fas fa-user"></i> - Mon profile</h1>
                        
                    </div>
                </div><!-- fin jumbotron -->
          
        <div class="container">
            
                    <?php 
                      //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                      $sql = $pdoCV->prepare(" SELECT * FROM t_utilisateurs " .$ordre);
                      $sql->execute();
                      $nbr_competences = $sql->rowCount();
                    ?>
                     <div class="container">
                        <img src="img_avatar.png" alt="Avatar" class="image">
                        <div class="overlay">Bonjour Setti</div>
                    </div> 
                         
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Administrateur</h5>
                            <p class="card-text">Bien venue dans mon admin.</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Cras justo odio</li>
                            <li class="list-group-item">Dapibus ac facilisis in</li>
                            <li class="list-group-item">Vestibulum at eros</li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>


               
            
        </div><!-- fin .container-->
      
  
<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises
