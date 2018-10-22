<?php require 'inc/connexion.php';


//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'competences') {
        $ordre = ' ORDER BY competence';
    }

    if ($_GET['ordre'] == 'asc') {
        $ordre .= ' ASC';
    } elseif ($_GET['ordre'] == 'desc') {
        $ordre .= ' DESC';
    }
}

// insertion d'un élément dans la base 
if (isset($_POST['competence'])) {//si on a reçu une nouvelle compétence

    if ($_POST['competence'] != '' && $_POST['niveau'] != '' && $_POST['categorie'] != '') {

        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);

        $pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1') ");

        header("location: ../admin/competences.php");
        exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if (isset($_GET['id_competence'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_competence'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_competences WHERE id_competence = '$efface' ";//delete de la base

    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/competences.php");
}//ferme le if isset pour la suppression

?>
<!doctype html>
<html lang="fr">
   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
            //requête pour une seule info avec la condition de la variable $id_utilisateur
            $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='$id_utilisateur' ");
            $ligne_utilisateur = $sql->fetch();
        ?>
        
        <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
        <?php require 'inc/head.php'; ?>
   </head>

   <body>
        <div class="container-fluid">
            <?php require 'inc/navigation.php'; ?>
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">

                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php"><span data-feather="home"></span>Dashboard <span class="sr-only">(current)</span></a>

                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                <span data-feather="users"></span>
                                profile
                                </a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="admin/competences.php" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mes contenus</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown08">
                                    <a class="dropdown-item" href="competences.php"><i class="fas fa-book-reader"></i> - Compétences</a>
                                    <a class="dropdown-item" href="loisirs.php"><i class="fas fa-bicycle"></i> - Loisirs</a>
                                    <a class="dropdown-item" href="formations.php"><i class="fas fa-school"></i> - Formations</a>
                                    <a class="dropdown-item" href="experiences.php"><i class="fas fa-school"></i> - Experiences</a>
                                    <a class="dropdown-item" href="reseaux.php"><i class="fas fa-school"></i> - Reseaux</a>
                                    <a class="dropdown-item" href="messages.php"><i class="fas fa-school"></i> - Messages</a>
                                    <a class="dropdown-item" href="realisations.php"><i class="fas fa-school"></i> - Réalisation</a>
                                    <a class="dropdown-item" href="titres.php"><i class="fas fa-school"></i> - Titres </a>
                                </div>
                            </li>
                            
                        </ul>

                    </div>
                </nav><!-- fin sidebar -->

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4"><i class="fas fa-book-reader"></i> - Les compétences</h1>
                            <p class="lead">Gestion des données de mon CV.</p>
                        </div>
                    </div>

                    <h2>Section title</h2>
                    <div class="row">
                        <div class="col-lg-8 bg-secondary">
                            <?php 
                            //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                            $sql = $pdoCV->prepare(" SELECT * FROM t_competences $ordre");
                            $sql->execute();
                            $nbr_competences = $sql->rowCount();
                            ?>
                            <div class="table-responsive">
                                <div class="card-header">
                                    La liste des compétences : <?php echo $nbr_competences; ?>
                                </div>
                                <table class="table table-striped table-sm">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th><a href="competences.php?colonne=competences&ordre=desc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-down.png"></a>Compétences  - <a href="competences.php?colonne=competences&ordre=asc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-up.png"></a></th>
                                        <th>Niveau</th>
                                        <th>Catégorie</th>
                                        <th>Modification</th>
                                        <th>Suppression</th>
                                    </tr>
                                </thead>
                                <tbody class="thead-light">
                                    <?php while ($ligne_competence = $sql->fetch()) {

                                        echo '<tr>';

                                        echo '<td>' . $ligne_competence['competence'] . '</td><td>' . $ligne_competence['niveau'] . '</td><td>' . $ligne_competence['categorie'] . '</td><td> <a href="modif_competence.php?id_competence=' . $ligne_competence['id_competence'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette competence?\'))"><i class="fas fa-edit"></i></a></td>';

                                        echo '<td> <a href="?id_competence=' . $ligne_competence['id_competence'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette competence?\'))" ><i class="far fa-trash-alt"></i></a></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div><!-- fin resposive -->
                        </div><!-- fin .col-lg-8 -->
                        <div class="col-lg-4">
                            <div class="card text-white bg-secondary mb-3">
                                <div class="card-header">Insertion d'une nouvelle compétences :</div>
                                <div class="card-body">
                                    <form action="competences.php" method="post">
                        
                                        <div class="form-group">
                                            <label for="competence">Compétence</label>
                                            <input type="text" name="competence" class="form-control" placeholder="nouvelle compétence" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="niveau">Niveau</label>
                                            <input type="text" name="niveau" class="form-control" placeholder="niveau en chiffre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="categorie">Catégorie</label>
                                            <select name="categorie" class="form-control">
                                                    <option value="Back">Back</option>
                                                    <option value="CMS">CMS</option>
                                                    <option value="Frameworks">Frameworks</option>
                                                    <option value="Front">Front</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Insérer une compétence</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- fin .row -->
                </main>
            </div><!-- fin .row -->
        </div><!-- .fin container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        

        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
        feather.replace()
        </script>

        
   </body>
</html>
