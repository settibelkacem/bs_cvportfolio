<?php require 'inc/connexion.php'; 

// insertion d'un élément dans la base 
if(isset($_POST['titre_form'])){//si on a reçu une nouvelle formation

    if($_POST['titre_form']!='' && $_POST['dates_form']!='' && $_POST['titre_form']!='' && $_POST['description_form']!=''){

        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $dates_form = addslashes($_POST['dates_form']);
		$description_form = addslashes($_POST['description_form']);

        $pdoCV->exec(" INSERT INTO t_formations VALUES (NULL, '$titre_form', '$stitre_form', '$dates_form', '$description_form', '1') "); 

        header("location: ../admin/formations.php");
            exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if(isset($_GET['id_formation'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_formation'];// je passe l'id dans une variable $efface

    $sql =" DELETE FROM t_formations WHERE id_formation = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/formations.php");
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
  <h1 class="display-4"><i class="fas fa-school"></i> - Les formations</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <a class="btn btn-primary btn-lg" href="#" role="button">VOIR</a>
</div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 col-xl-5 fondbleu">
		 <?php 
            //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_formations ");
            $sql->execute();
            $nbr_formations = $sql->rowCount();
    ?>
    
        <?php while($ligne_formation=$sql->fetch(	)) 
            {
        ?>
		 <div class="card mb-4">
  <div class="card-header">
      <?php echo $ligne_formation['dates_form'].' // '.$ligne_formation['titre_form'].' <span class="badge badge-secondary"># '.$ligne_formation['id_formation']; ?></span>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $ligne_formation['stitre_form']; ?></h5>
    <p class="card-text"><?php echo $ligne_formation['description_form']; ?></p>
    <div class="btn-group btn-group-sm" role="group"><a href="modif_formation.php?id_formation=<?php echo $ligne_formation['id_formation']; ?>" class="btn btn-primary">Mise à jour</a><a href="formations.php?id_formation=<?php echo $ligne_formation['id_formation']; ?>" class="btn btn-danger">Suppr.</a></div>
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
      <label for="titre_form">Titre formation</label>
      <input type="titre_form" class="form-control" name="titre_form" placeholder="titre">
    </div>
	  <div class="form-group col-md-6">
		<label for="dates_form">Dates</label>
		<input type="text" class="form-control" name="dates_form" placeholder="ex. 2018/2019">
	  </div>
   
  </div>
	 <div class="form-group">
      <label for="stritre_form">Sous-titre</label>
      <input type="text" class="form-control" name="stritre_form" placeholder="sous-titre">
    </div>
  <div class="form-group">
    <label for="description_form">Description VOIR</label>
    <textarea type="text" class="form-control" name="description_form" id="editor">text</textarea>
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