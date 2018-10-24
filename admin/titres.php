<?php require 'inc/init.inc.php'; ?>
<?php require 'inc/acces_admin.php'; 

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'titres') {
        $ordre = ' ORDER BY titre';
    }

    if ($_GET['ordre'] == 'asc') {
        $ordre .= ' ASC';
    } elseif ($_GET['ordre'] == 'desc') {
        $ordre .= ' DESC';
    }
}

// insertion d'un élément dans la BDD 
if (isset($_POST['titre'])) {//si on a reçu un nouveau loisir

    if ($_POST['titre'] != '') {

        $titre = addslashes($_POST['titre']);
        $accroche = addslashes($_POST['accroche']);
        $pdoCV->exec(" INSERT INTO t_titres VALUES (NULL, '$titre', '$accroche', '$id_utilisateur') ");

        header("location: ../admin/titres.php");
        exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if (isset($_GET['id_titre'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_titre'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_titres WHERE id_titre = '$efface' ";//delete de la base
    $pdoCV->query($sql);

    header("location: ../admin/titres.php");
}//ferme le if isset pour la suppression

//-------------------AFFICHAGE--------------------------------------
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
    <title>Admin :  les titres <?php echo $ligne_utilisateur['pseudo']; ?></title>
	<?php require 'inc/head.php'; ?>
</head>

<body class="text-center">

    <div class="container-fluid">
        <?php require 'inc/navigation.php'; ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><i class="fas fa-table-tennis"></i> - Les titres</h1>
                <p class="lead">Gestion des données de mon CV.</p>
            </div>
        </div><!-- fin jumbotron --> 
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card text-dark mb-3">
                        <?php 
                            //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                        $sql = $pdoCV->prepare(" SELECT * FROM t_titres  WHERE id_utilisateur = '$id_utilisateur' " .$ordre );
                        $sql->execute();
                        $nbr_titres = $sql->rowCount();
                        ?>

                        <div class="card-header">
                            La liste des titres : <?php echo $nbr_titres; ?>
                        </div>
                        <div class="card-body table-responsive-sm table-responsive-md">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><a href="titres.php?colonne=titre&ordre=desc"><i class="fas fa-arrow-circle-down"></i></a> - Loisirs - <a href="loisirs.php?colonne=loisirs&ordre=asc"><i class="fas fa-arrow-circle-up"></i></a></th>
                                        <th>Modifier</th>
                                        <th>Suppression</th>
                                    </tr>
                                </thead>
                                <tbody class="thead-light">
                                    <?php while ($ligne_titre = $sql->fetch()) {

                                        echo '<tr>';
                                        echo '<td>' . $ligne_titre['titre'] . '</td><td><a href="modif_titre.php?id_titre=' . $ligne_titre['id_titre'] . '"onclick="return(confirm(\'Etes-vous certain de vouloir modifier ce titre ?\'))"><i class="fas fa-edit"></a></td>';
                                        echo '<td><a href="?id_titre=' . $ligne_titre['id_titre'] . '"onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce titre?\'))" ><i class="far fa-trash-alt"></a></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- fin div .card-body table-responsive-sm table-responsive-md -->
                    </div><!-- fin div .card text-dark bg-info mb-3 -->
                </div><!-- fin div .col-sm-12 col-md-12 col-lg-12 w-75 p-3 -->

                <!-- insertion d'un nouveau titre formulaire -->
            
                <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header">Insertion d'un nouveau titre :</div>
                            <div class="card-body">
                                <form action="titres.php" method="post">
                                    <div class="form-group">
                                        <label for="titre">Le titre</label>
                                        <input type="text" name="titre" class="form-control" placeholder="nouveau titre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="accroche">L' accroche</label>
                                        <input type="text" name="accroche" class="form-control" placeholder="nouveau accroche" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Insérer un titre</button>
                                    </div>
                                </form>
                            </div>    
                        </div>
                    </div>
                </div>
            </div><!-- fin div .row -->
        </div> <!-- fin div .container -->
   
<?php
require_once 'inc/bas.inc.php'; // footer et fermeture des balises
    