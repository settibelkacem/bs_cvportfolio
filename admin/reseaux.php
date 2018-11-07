<?php require 'inc/init.inc.php'; 
    require 'inc/acces_admin.php'; 
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
//--------------------AFFICHAGE------------------------------
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
        <title>Admin :  les reseaux <?php echo $ligne_utilisateur['pseudo']; ?></title>
        <?php require 'inc/head.php'; ?>
    </head>

    <body class="text-center">
        <div class="container-fluid">
        <?php require 'inc/navigation.php'; ?>
	  
            <div class="jumbotron">
                
                <h1 class="display-4"><i class="fas fa-bicycle"></i> - Les reseaux</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </div><!-- fin jumbotron -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xl-8">
                    <?php 
                    //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                    $sql = $pdoCV->prepare(" SELECT * FROM t_reseaux  WHERE id_utilisateur = '$id_utilisateur' $ordre ");
                    $sql->execute();
                    $nbr_reseaux = $sql->rowCount();
                    ?>
                    <div class="table-responsive">
                        <div class="card-header">
                            La liste des reseaux : <?php echo $nbr_reseaux; ?>
                        </div>
                        <table table table-striped table-sm>
                            
                            <thead class="thead-dark">
                                <tr>
                                    <th><a href="reseaux.php?colonne=reseaux&ordre=desc"><i class="fas fa-arrow-circle-up"></i></a> - reseaux - <a href="reseaux.php?colonne=reseaux&ordre=asc"><i class="fas fa-arrow-circle-down"></i></a></th>
                                    <th>Modifier</th>
                                    <th>Suppression</th>
                                </tr>
                            </thead>
                            <tbody class="thead-light">
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
                    </div><!-- fin div .table-responsive -->
                </div><!-- fin div .col-sm-12 col-xl-8 -->
                <!-- insertion d'un nouveau reseau au formulaire -->
                <div class="col-sm-12 col-md-12 col-xl-4 rose">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header">
                            Insertion d'un nouveau reseau :
                        </div>
                        <div class="card-body">
                            <form action="reseaux.php" method="post">
                                <div class="">
                                        <label for="url">reseau</label>
                                        <input type="text" name="url" placeholder="nouveau url" required>
                                </div>
                                <div class="">
                                        <button type="submit">Insérer un reseau</button>
                                </div>
                            </form>
                        </div><!-- fin div .card-body -->
                    </div><!-- fin div .card -->
                </div><!-- fin div .col -->
            </div><!-- fin div .row -->
  </div><!-- fin div .container -->
<?php 
require_once 'inc/bas.inc.php'; // footer et fermeture des balises
