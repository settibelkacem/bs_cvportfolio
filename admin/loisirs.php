<?php require 'inc/init.inc.php'; 
 require 'inc/acces_admin.php';

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if(isset($_GET['ordre']) && isset($_GET['colonne'])){
	
	if($_GET['colonne'] == 'loisirs'){
		$ordre = ' ORDER BY loisir';
	}
	
	if($_GET['ordre'] == 'asc'){
		$ordre .= ' ASC';
	}
	elseif($_GET['ordre'] == 'desc'){
		$ordre .= ' DESC';
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
//-----------------------------AFFICHAGE---------------------------
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
    </div><!-- fin jumbotron -->

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card text-dark mb-3">
                    <?php 
                        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                        $sql = $pdoCV->prepare(" SELECT * FROM t_loisirs".$ordre);
                        $sql->execute();
                        $nbr_loisirs = $sql->rowCount();
                    ?>

                    <div class="card-header">
                        La liste des loisirs : <?php echo $nbr_loisirs; ?>
                    </div>
                    <div class="card-body table-responsive-sm table-responsive-md">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="loisirs.php?colonne=loisirs&ordre=desc">
                                            <i class="fas fa-arrow-circle-down"></i>
                                        </a> 
                                            - Loisirs - 
                                        <a href="loisirs.php?colonne=loisirs&ordre=asc">
                                            <i class="fas fa-arrow-circle-up"></i>
                                        </a>
                                    </th>

                                    <th>Modifier</th>
                                    <th>Suppression</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($ligne_loisir=$sql->fetch()) 
                                    {
                            
                                    echo '<tr>';
                                        echo '<td>'. $ligne_loisir['loisir'] . '</td>';
                                        echo '<td><a href="modif_loisir.php?id_loisir='.  $ligne_loisir['id_loisir'].'"onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette competence?\'))"><i class="fas fa-edit"></a></td>';
                                        echo '<td><a href="loisirs.php?id_loisir=' . $ligne_loisir['id_loisir'] . '"onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette competence?\'))" ><i class="far fa-trash-alt"></a></td>'; 
                                    echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- fin div .card-body table-responsive-sm table-responsive-md -->
                </div><!-- fin div .card text-dark bg-info mb-3 -->
            </div><!-- fin div .col-sm-12 col-md-8 col-lg-4 w-75 p-3 -->

            <!-- insertion d'un nouveau loisir formulaire -->


            <div class="col-sm-12 col-md-6 col-lg-6 mt-5">
                <div class="card text-dark mb-3">
                    <div class="card-header">Insertion d'un nouveau loisir :</div>
                        <div class="card-body">
                            <form class="form-inline" action="loisirs.php" method="post">
                                <div class="form-group mb-2 ml-5 mr-2">
                                    <label for="loisir" class="sr-only">Loisir</label>
                                    <input type="text" name="loisir" class="form-control" placeholder="nouveau loisir" required>
                                </div>
                                
                                <button class="btn btn-primary mb-2" type="submit">Insérer un loisir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- fin div .container -->

<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises