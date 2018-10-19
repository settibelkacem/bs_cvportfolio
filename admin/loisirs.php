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
	
	if($_GET['colonne'] == 'loisirs'){
		$ordre = ' ORDER BY loisir';
	}
	
	if($_GET['ordre'] == 'asc'){
		$ordre.= ' ASC';
	}
	elseif($_GET['ordre'] == 'desc'){
		$ordre.= ' DESC';
	}
}

// insertion d'un élément dans la BDD 
if(isset($_POST['loisir'])){//si on a reçu un nouveau loisir

        if($_POST['loisir']!=''){

            $loisir = addslashes($_POST['loisir']);
            $pdoCV->exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '$id_utilisateur') ");

            header("location: ../admin/loisirs.php");
                exit();

        }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if(isset($_GET['id_loisir'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_loisir'];// je passe l'id dans une variable $efface

    $sql =" DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/loisirs.php");
}//ferme le if isset pour la suppression

?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
        //requête pour une seule info avec la condition de la variable $id_utilisateur
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin :  les loisirs <?php echo $ligne_utilisateur['pseudo']; ?></title>
	<?php require 'inc/head.php'; ?>
</head>

  <body class="text-center">
	  <div class="container-fluid">
		   <?php require 'inc/navigation.php'; ?>
  
	    <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><i class="fas fa-table-tennis"></i> - Les loisirs</h1>
                <p class="lead">Gestion des données de mon CV.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 w-75 p-3">
                <div class="card text-dark bg-primary mb-3">
                    <?php 
                        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                        $sql = $pdoCV->prepare(" SELECT * FROM t_loisirs  WHERE id_utilisateur = '$id_utilisateur' $ordre ");
                        $sql->execute();
                        $nbr_loisirs = $sql->rowCount();
                    ?>

                    <div class="card-header">
                        La liste des loisirs : <?php echo $nbr_loisirs; ?>
                    </div>
                    <div class="card-body table-responsive-sm table-responsive-md">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th><a href="loisirs.php?colonne=loisirs&ordre=desc"><i class="fas fa-arrow-circle-down"></i></a> - Loisirs - <a href="loisirs.php?colonne=loisirs&ordre=asc"><i class="fas fa-arrow-circle-up"></i></a></th>
                                    <th>Modifier</th>
                                    <th>Suppression</th>
                                </tr>
                            </thead>
                            <tbody class="thead-light">
                                <?php while($ligne_loisir=$sql->fetch()) 
                                    {
                            
                                    echo '<tr>';
                                        echo '<td>'. $ligne_loisir['loisir'] . '</td><td><a href="modif_loisir.php?id_loisir='.  $ligne_loisir['id_loisir'].'"onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette competence?\'))"><i class="fas fa-edit"></a></td>';
                                        echo '<td><a href="loisirs.php?id_loisir=' . $ligne_loisir['id_loisir'] . '"onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette competence?\'))" ><i class="far fa-trash-alt"></a></td>'; 
                                    echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- fin div .card-body table-responsive-sm table-responsive-md -->
                </div><!-- fin div .card text-dark bg-info mb-3 -->
            </div><!-- fin div .col-sm-12 col-md-12 col-lg-12 w-75 p-3 -->

            <!-- insertion d'un nouveau loisir formulaire -->
            
            <div class="col-sm-12 col-lg-6 mx-auto">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Insertion d'une nouveau loisir :</div>
                        <div class="card-body">
                            <form action="loisirs.php" method="post">
                                <div class="form-group">
                                    <label for="loisir">Loisir</label>
                                    <input type="text" name="loisir" class="form-control" placeholder="nouveau loisir" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Insérer un loisir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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