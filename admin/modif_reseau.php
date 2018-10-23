<?php require 'inc/connexion.php'; ?>
<?php require 'inc/acces_admin.php'; 


//gestion mise à jour d'une information
if(isset($_POST['nom_reseau'])){

    $reseau = addslashes($_POST['nom_reseau']);
    $url = addslashes($_POST['url']);
    $id_url = $_POST['id_url'];
    
    
    $pdoCV->exec(" UPDATE t_reseaux SET nom_reseau='$reseau', url='$url' WHERE id_url='$id_url' ");
    header('location: ../admin/reseaux.php');
    exit();
}

//je récupère l'id de ce que je mets à jour
$id_url = $_GET['id_url']; // par son id et avec GET
$sql = $pdoCV->query(" SELECT * FROM t_reseaux WHERE id_url='$id_url' ");
$ligne_url = $sql->fetch();//va chercher 
//------------------------AFFICHAGE------------------------------
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour url</title>
</head>
<body>
    <div class="container-fluid">
        <h1>Mise à jour d'un url</h1>
    <!-- mise à jour formulaire -->
        <form action="modif_reseau.php" method="post">
            <div class="form-group">
                <label for="nom_reseau">Nom du reseau</label><br>
                <input type="text" class="form-control" name="nom_reseau" id="nom_reseau" value="<?php echo $ligne_url['nom_reseau']; ?>" required">
            </div>
        <div class="">
                <label for="url">L'url du reseau</label>
                <input type="text" name="url" value="<?php echo $ligne_url['url']; ?>" required>
        </div>
        <div class="">
        <input type="hidden" name="id_url" value="<?php echo $ligne_url['id_url']; ?>">
                <button type="submit">MAJ</button>
        </div>
        </form>

    

<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises