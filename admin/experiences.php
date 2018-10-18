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
	
	if($_GET['colonne'] == 'experiences'){
		$ordre = ' ORDER BY experience';
	}
	
	if($_GET['ordre'] == 'asc'){
		$ordre.= ' ASC';
	}
	elseif($_GET['ordre'] == 'desc'){
		$ordre.= ' DESC';
	}
}

// insertion d'un élément dans la base 
if (isset($_POST['titre_exp'])) {//si on a reçu une nouvelle experience

    if ($_POST['titre_exp'] != '' && $_POST['dates_exp'] != '' && $_POST['stitre_exp'] != '' && $_POST['description_exp'] != '') {

        $titre_exp = addslashes($_POST['titre_exp']);
        $stitre_exp = addslashes($_POST['stitre_exp']);
        $dates_exp = addslashes($_POST['dates_exp']);
        $description_exp = addslashes($_POST['description_exp']);

        $pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '1') ");

        header("location: ../admin/experiences.php");
        exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if (isset($_GET['id_experience'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_experience'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_experiences WHERE id_experience = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/experiences.php");
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
                    <h1 class="display-4"><i class="fas fa-school"></i> - Les experiences</h1>
                    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-lg" href="#" role="button">VOIR</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-5 fondbleu">

                    <?php 
                    //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                    $sql = $pdoCV->prepare(" SELECT * FROM t_experiences $ordre ");
                    $sql->execute();
                    $nbr_experiences = $sql->rowCount();
                    ?>
        
                    <?php while ($ligne_experience = $sql->fetch()) {
                    ?>
                    <div class="card mb-4">
                        <div class="card-header">
                        <?php echo $ligne_experience['dates_exp'] . ' // ' . $ligne_experience['titre_exp'] . ' <span class="badge badge-secondary"># ' . $ligne_experience['id_experience']; ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $ligne_experience['stitre_exp']; ?></h5>
                            <p class="card-text"><?php echo $ligne_experience['description_exp']; ?></p>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>" class="btn btn-primary">Mise à jour</a><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>" class="btn btn-danger">Suppr.</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>
                </div>
                <div class="col-sm-12 col-md-12 col-xl-7 rose">
                    <form action="formations.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="titre_exp">Titre experience</label>
                                <input type="titre_exp" class="form-control" name="titre_exp" placeholder="titre">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dates_exp">Dates</label>
                                <input type="text" class="form-control" name="dates_exp" placeholder="ex. 2018/2019">
                            </div>
    
                        </div>
                        <div class="form-group">
                            <label for="stritre_exp">Sous-titre</label>
                            <input type="text" class="form-control" name="stritre_exp" placeholder="sous-titre">
                        </div>
                        <div class="form-group">
                            <label for="description_exp">Description VOIR</label>
                            <textarea type="text" class="form-control" name="description_exp" id="editor">text</textarea>
                            <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#editor' ) )
                                        .then( editor => {
                                            console.log( editor );
                                        } )
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                        </div>
                        <button type="submit" class="btn btn-primary">Insérer</button>
                    </form><!-- fin formulaire -->
                </div><!-- fin div .rose -->
            </div><!-- fin div .row -->
        </div><!-- fin div .container -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>