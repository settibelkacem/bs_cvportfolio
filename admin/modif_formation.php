<?php require 'inc/connexion.php'; 

    //gestion mise à jour d'une information
    if(isset($_POST['titre_form'])){

        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $dates_form = addslashes($_POST['dates_form']);
        $description_form = addslashes($_POST['description_form']);
        $id_formation = $_POST['id_formation'];

        $pdoCV->exec(" UPDATE t_formations SET titre_form='$titre_form', stitre_form='$stitre_form', dates_form='$dates_form', description_form=$description_form WHERE id_formation='$id_formation' ");
        header('location: ../admin/formations.php');
        exit();
    }
    //je récupère l'id de ce que je mets à jour
    $id_formation = $_GET['id_formation']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_formations WHERE id_formation='$id_formation' ");
    $ligne_formation = $sql->fetch();//va chercher !

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour formation</title>
</head>
<body>
    <h1>Mise à jour d'un loisir</h1>
    <!-- mise à jour formulaire -->
    <form action="modif_formationtitre_form.php" method="post">
        <div class="form-group">
            <label for="titre_form">Titre de formation</label>
            <input type="text" name="titre_form" class="form-control" value="<?php echo $ligne_formation['titre_form']; ?>" required>
        </div>
        <div class="form-group">
            <label for="stitre_form">Sous titre</label>
            <input type="text" name="stitre_form" class="form-control" value="<?php echo $ligne_formation['stitre_form']; ?>" required>
        </div>
        <div class="form-group">
            <label for="dates_form">Date de formation</label>
            <input type="text" name="dates_form" class="form-control" value="<?php echo $ligne_formation['dates_form']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description_form">Description</label>
            <textarea type="text" class="form-control" name="description_form" value="<?php echo $ligne_formation['description_form']; ?>">text</textarea>
        <div class="form-group">
        <input type="hidden" name="id_formation" class="form-control" value="<?php echo $ligne_formation['id_formation']; ?>">
            <button type="submit">MAJ</button>
        </div>
    </form>
</body>
</html>