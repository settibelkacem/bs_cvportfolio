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
if(isset($_GET['quitter'])){//on récupère le terme quiiter en GET

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
	
	if($_GET['colonne'] == 'competences'){
		$ordre = ' ORDER BY competence';
	}
	
	if($_GET['ordre'] == 'asc'){
		$ordre.= ' ASC';
	}
	elseif($_GET['ordre'] == 'desc'){
		$ordre.= ' DESC';
	}
}


// insertion d'un élément dans la base 
if(isset($_POST['competence'])){//si on a reçu une nouvelle compétence

    if($_POST['competence']!='' && $_POST['niveau']!='' && $_POST['categorie']!=''){

        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);

        $pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1') "); 

        header("location: ../admin/competences.php");
            exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if(isset($_GET['id_competence'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_competence'];// je passe l'id dans une variable $efface

    $sql =" DELETE FROM t_competences WHERE id_competence = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/competences.php");
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
        <!-- icons8 -->
        <a href="https://icons8.com">Icon pack by Icons8</a>
        <?php
            //requête pour une seule info
            $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs ");
            $ligne_utilisateur = $sql->fetch();
        ?>
        <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
    <?php require 'inc/head.php'; ?>
    </head>
    <body> 
        <div class="container">
            <?php require 'inc/navigation.php'; ?>
            <div class="row">
                <div class="jumbotron"> 
                    <h1 class="display-4"><i class="fas fa-book-reader"></i> - Les compétences</h1>
                    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-lg" href="#" role="button">VOIR</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xl-8 fondbleu">
                    <div class="">
                        <?php 
                        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                        $sql = $pdoCV->prepare(" SELECT * FROM t_competences $ordre ");
                        $sql->execute();
                        $nbr_competences = $sql->rowCount();
                        ?>
                        <table border="1">
                            <caption>La liste des compétences : <?php echo $nbr_competences; ?></caption>
                            <thead>
                                <tr>
                                    <th><a href="competences.php?colonne=competences&ordre=desc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-down.png"></a>Compétences  - <a href="competences.php?colonne=competences&ordre=asc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-up.png"></a></th>
                                    <th>Niveau</th>
                                    <th>Catégorie</th>
                                    <th>Modification</th>
                                    <th>Suppression</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($ligne_competence=$sql->fetch()) 
                                    {
                                ?>
                                <tr>
                                    <td><?php echo $ligne_competence['competence']; ?></td>
                                    <td><?php echo $ligne_competence['niveau']; ?></td>
                                    <td><?php echo $ligne_competence['categorie']; ?></td>
                                    <td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">modif.</a></td>
                                    <td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">suppr</a></td>
                                </tr>
                                <?php 
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 rose">
                <!-- insertion d'une nouvelle compétence formulaire -->
                    <form action="competences.php" method="post">
                        <div class="">
                            <label for="competence">Compétence</label>
                            <input type="text" backname="competence" placeholder="nouvelle compétence" required>
                        </div>
                        <div class="">
                            <label for="niveau">Niveau</label>
                            <input type="text" name="niveau" placeholder="niveau en chiffre" required>
                        </div>
                        <div class="">
                            <label for="categorie">Catégorie</label>
                            <select name="categorie">
                                    <option value="Back">Back</option>
                                    <option value="CMS">CMS</option>
                                    <option value="Frameworks">Frameworks</option>
                                    <option value="Front">Front</option>
                            </select>
                        </div>
                        <div class="">
                            <button type="submit">Insérer une compétence</button>
                        </div>
                    </form>
                </div><!--fin col 2-->
            </div><!--fin row-->
        </div><!--fin container-->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>