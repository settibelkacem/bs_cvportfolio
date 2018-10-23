    <?php 
    require 'admin/inc/init.inc.php';

    session_start();// à mettre dans toutes les pages de l'admin 
//traitement pour la connexion à l'admin 

    if (isset($_POST['connexion'])) {// connexion est le name du button
      $email = addslashes($_POST['email']);
      $mdp = addslashes($_POST['mdp']);

      $sql = $pdoCV->prepare(" SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' "); // on vérifie email ET mot de passe
      $sql->execute();
      $nbr_utilisateur = $sql->rowCount();// on compte si il est dans la BDD ; le compte répond 0 s'il n'y est pas et répond 1 s'il y est
      if ($nbr_utilisateur == 0) {// il n'y est pas !
        echo '<p>Erreur !</p>';
      } else {
        // echo $nbr_utilisateur; // il y est ! 
        $ligne_utilisateur = $sql->fetch();
        $_SESSION['connexion_admin'] = 'connecté'; // connexion pour l'admin

        $_SESSION['id_utilisateur'] = $ligne_utilisateur['id_utilisateur'];
        $_SESSION['email'] = $ligne_utilisateur['email'];
        $_SESSION['nom'] = $ligne_utilisateur['nom'];
        $_SESSION['mdp'] = $ligne_utilisateur['mdp'];
        //echo $ligne_utilisateur['nom'];
        header('location:admin/index.php');
      }
    }
    ?>
   
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
  
     <?php require 'admin/inc/head.php'; ?>
    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="authentification.php" method="post">
      <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="email" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
      <label for="mdp" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="mdp">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="connexion">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
