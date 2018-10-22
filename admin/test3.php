<?php require 'inc/connexion.php'; 
 require 'inc/head.php'; 
 require 'inc/navigation.php';

session_start();// à mettre dans toutes les pages de l'admin 

if (isset($_SESSION['connexion_admin'])) {// si on est connecté on récupère les variables de session

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $email = $_SESSION['email'];
    $mdp = $_SESSION['mdp'];
    $nom = $_SESSION['nom'];

    // echo $id_utilisateur;
} else {// si on n'est pas connecté on ne peut pas accéder à l'admin
    header('location:../authentification.php');
}
//pour vider les variables de session on destroy !
if (isset($_GET['quitter'])) {//on récupère le terme quiiter en GET

    $_SESSION['connexion_admin'] = '';
    $_SESSION['id_utilisateur'] = '';
    $_SESSION['email'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['mdp'] = '';

    unset($_SESSION['connexion_admin']);//unset détruit la variable connexion_admin
    session_destroy();//on détruit la session

    header('location:../authentification.php');
}

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'formations') {
        $ordre = ' ORDER BY formation';
    }

    if ($_GET['ordre'] == 'asc') {
        $ordre .= ' ASC';
    } elseif ($_GET['ordre'] == 'desc') {
        $ordre .= ' DESC';
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
</head>
<body>
    <div class="container-fluid">
         <div class="row">
            <div class="col-sm-3 col-md-3 col-lg-3 w-25 p-3">
                 <!-- The sidebar -->
                <div class="sidebar">
                    <a class="active" href="#home">Home</a>
                    <a href="#news">News</a>
                    <a href="#contact">Contact</a>
                    <a href="#about">About</a>
                </div>

            </div><!-- fin div .col-sm-3-->
            <div class="col-sm-9 col-md-9 col-lg-9 w-75 p-3">
                <main role="main" class="col-md-9 col-lg-10">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                    This week
                            </button>
                        </div>
                    </div>

                    <div class="card-header">
                        La liste des compétences 
                    </div>
                    <div class="card-body table-responsive-sm table-responsive-md col-md-3 col-lg-2">
                        <table class="table table-hover">
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
                                <tr>
                                    <th><a href="competences.php?colonne=competences&ordre=desc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-down.png"></a>Compétences  - <a href="competences.php?colonne=competences&ordre=asc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-up.png"></a></th>
                                    <th>Niveau</th>
                                    <th>Catégorie</th>
                                    <th>Modification</th>
                                    <th>Suppression</th>
                                </tr>
                                <tr>
                                    <th><a href="competences.php?colonne=competences&ordre=desc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-down.png"></a>Compétences  - <a href="competences.php?colonne=competences&ordre=asc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-up.png"></a></th>
                                    <th>Niveau</th>
                                    <th>Catégorie</th>
                                    <th>Modification</th>
                                    <th>Suppression</th>
                                </tr>
                                <tr>
                                    <th><a href="competences.php?colonne=competences&ordre=desc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-down.png"></a>Compétences  - <a href="competences.php?colonne=competences&ordre=asc"><img src="https://png.icons8.com/material-two-tone/50/000000/sort-up.png"></a></th>
                                    <th>Niveau</th>
                                    <th>Catégorie</th>
                                    <th>Modification</th>
                                    <th>Suppression</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                        <div class="card text-white bg-dark mb-3">
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
                    </div>
                </main>
            </div><!-- fin div .col-sm-9-->
        </div><!-- fin div .row--> 
  



    </div><!-- fin div container -->



</body>
</html>