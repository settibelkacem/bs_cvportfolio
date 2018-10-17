<?php require 'inc/connexion.php';

session_start();// à mettre dans toutes les pages de l'admin 

if(isset($_SESSION['connexion_admin'])) {// si on est connecté on récupère les variables de session

    $id_utilisateur=$_SESSION['id_utilisateur'];
    $email=$_SESSION['email'];
    $mdp=$_SESSION['mdp'];
    $nom=$_SESSION['nom'];

    // echo $id_utilisateur;
}else{// si on n'est pas connecté on ne peut pas accéder à l'admin
  header('location:../authentification.php');
}
//pour vider les variables de session on destroy !
if(isset($_GET['quitter'])){//on récupère le terme quitter en GET

  $_SESSION['connexion_admin']='';
  $_SESSION['id_utilisateur']='';
  $_SESSION['email']='';
  $_SESSION['nom']='';
  $_SESSION['mdp']='';

    unset($_SESSION['connexion_admin']);//unset détruit la variable connexion_admin
    session_destroy();//on détruit la session

    header('location:../authentification.php');
}

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if(isset($_GET['ordre']) && isset($_GET['colonne'])){
	
	if($_GET['colonne'] == 'reseaux'){
		$ordre = ' ORDER BY nom_reseau';
	}
	
	if($_GET['ordre'] == 'asc'){
		$ordre.= ' ASC';
	}
	elseif($_GET['ordre'] == 'desc'){
		$ordre.= ' DESC';
	}
}

// insertion d'un élément dans la BDD 
if(isset($_POST['url'])){//si on a reçu un nouveau url

        if($_POST['url']!=''){

            $url = addslashes($_POST['url']);
            $pdoCV->exec(" INSERT INTO t_reseaux VALUES (NULL, '$url', '$id_utilisateur') ");

            header("location: ../admin/reseaux.php");
                exit();

        }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if(isset($_GET['id_url'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_url'];// je passe l'id dans une variable $efface

    $sql =" DELETE FROM t_reseaux WHERE id_url = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/reseaux.php");
}//ferme le if isset pour la suppression

?>

<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS en CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
        <?php
            //requête pour une seule info avec la condition de la variable $id_utilisateur
            $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
            $ligne_utilisateur = $sql->fetch();
        ?>
        <title>Admin :  les reseaux <?php echo $ligne_utilisateur['pseudo']; ?></title>
        <?php require 'inc/head.php'; ?>
    </head>

    <body>
	  <div class="container">
		   <?php require 'inc/navigation.php'; ?>
            <div class="row">
	            <div class="jumbotron">
		            <?php 
                    //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                    $sql = $pdoCV->prepare(" SELECT * FROM t_reseaux  WHERE id_utilisateur = '$id_utilisateur' $ordre ");
                    $sql->execute();
                    $nbr_reseaux = $sql->rowCount();
                    ?>
                    <h1 class="display-4"><i class="fas fa-bicycle"></i> - Les reseaux</h1>
                    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xl-8 fondbleu">
                    <div class="">
                        <table border="1">
                            <caption>La liste des reseaux : <?php echo $nbr_reseaux; ?></caption>
                            <thead>
                                <tr>
                                    <th><a href="reseaux.php?colonne=reseaux&ordre=desc"><i class="fas fa-arrow-circle-up"></i></a> - reseaux - <a href="reseaux.php?colonne=reseaux&ordre=asc"><i class="fas fa-arrow-circle-down"></i></a></th>
                                    <th>Modifier</th>
                                    <th>Suppression</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($ligne_url=$sql->fetch()) 
                                    {
                                ?>
                                <tr>
                                    <td><?php echo $ligne_url['url']; ?></td><td><a href="modif_url.php?id_url=<?php echo $ligne_url['id_url']; ?>">modif</a> </td>
                                    <td><a href="reseaux.php?id_url=<?php echo $ligne_url['id_url']; ?>">suppr</a> </td>
                                </tr>
                                <?php 
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-xl-4 rose">
                    <hr>
                    <!-- insertion d'un nouveau reseau au formulaire -->
                    <form action="reseaux.php" method="post">
                        <div class="">
                                <label for="url">reseau</label>
                                <input type="text" name="url" placeholder="nouveau url" required>
                        </div>
                        <div class="">
                                <button type="submit">Insérer un reseau</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>