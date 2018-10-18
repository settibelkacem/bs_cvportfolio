<?php require 'inc/connexion.php'; 

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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : les compétences</title>
</head>
<body>
<h1>Les compétences et insertion d'une nouvelle compétence</h1>
<?php 
            //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_competences $ordre ");
            $sql->execute();
            $nbr_competences = $sql->rowCount();
    ?>
<div class="">
    <table border="1">
    <caption>La liste des compétences : <?php echo $nbr_competences; ?></caption>
        <thead>
            <tr>
                <th><a href="competences.php?colonne=competences&ordre=desc">De Z à A</a>Compétences  - <a href="competences.php?colonne=competences&ordre=asc">De A à Z</a></th>
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
<hr>
<!-- insertion d'une nouvelle compétence formulaire -->
<form action="competences.php" method="post">
   <div class="">
        <label for="competence">Compétence</label>
        <input type="text" name="competence" placeholder="nouvelle compétence" required>
   </div>
   <div class="">
        <label for="niveau">Niveau</label>
        <input type="text" name="niveau" placeholder="niveau en chiffre" required>
   </div>
   <div class="">
        <label for="categorie">Catégorie</label>
        <select name="categorie">
                <option value="Développement">Développement</option>
                <option value="Gestion de projet">Gestion de projet</option>
                <option value="Infographie">Infographie</option>
        </select>
   </div>
   <div class="">
        <button type="submit">Insérer une compétence</button>
   </div>
</form>

</body>
</html>