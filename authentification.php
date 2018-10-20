<?php require 'admin/inc/connexion.php'; 

session_start();// à mettre dans toutes les pages de l'admin 

//traitement pour la connexion à l'admin 
if(isset($_POST['connexion'])) {// connexion est le name du button

    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);

    $sql = $pdoCV -> prepare (" SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' "); // on vérifie email ET mot de passe
    $sql -> execute();
    $nbr_utilisateur = $sql -> rowCount();// on compte si il est dans la BDD ; le compte répond 0 s'il n'y est pas et répond 1 s'il y est

    if($nbr_utilisateur == 0) {// il n'y est pas !
        echo '<p>Erreur !</p>';
    }else{
        // echo $nbr_utilisateur; // il y est ! 
        $ligne_utilisateur =  $sql -> fetch();

        $_SESSION['connexion_admin'] = 'connecté'; // connexion pour l'admin
        
		$_SESSION['id_utilisateur']=$ligne_utilisateur['id_utilisateur'];
        $_SESSION['email'] = $ligne_utilisateur['email'];
        $_SESSION['nom'] = $ligne_utilisateur['nom'];
        $_SESSION['mdp'] = $ligne_utilisateur['mdp'];
        //echo $ligne_utilisateur['nom'];
        header('location:admin/index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS en CDN-->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">  -->
    <title>Admin : authentification</title><!--	  google font Montserrat et Open sans-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600|Open+Sans:400,400i,600" rel="stylesheet"> 
<!--font awesome	  -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Bootstrap CSS en local-->
<link href="admin/css/bootstrap-4.0.0.css" rel="stylesheet">
<!--	mes styles-->
<link href="admin/css/admin.css" rel="stylesheet" type="text/css">

</head>
<body class="text-center">
    <!-- <form action="authentification.php" method="post">
        <h1>Admin : authentification</h1>
            <label for="email">Votre email</label>
            <input type="email" name="email" class="form-control" placeholder="coucou@coucou.fr" required>

            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" class="form-control" placeholder="vous seul le connaissez" required>
        <button name="connexion" type="submit" class="form-control">Se connecter</button>
    </form> -->

    <div class="container">
        <form class="form-horizontal form-signin" role="form" method="POST" action="authentification.php">
            <div class="row text-center mb-4">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2 class="h3 mb-3 font-weight-normal">>Authentification</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="<<ù">
                    <div class="form-group has-danger">
                    <label for="email" class="sr-only">Votre email</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                            <input type="text" name="email" class="form-control" id="email"
                                   placeholder="vous@exemple.com" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <i class="fa fa-close"></i> 
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="mdp">Password</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                            <input type="password" name="mdp" class="form-control" id="mdp"
                                   placeholder="mot de passe" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                        <!-- Put password error message here Erreur d'authentification -->    
                        </span>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="padding-top: .35rem">
                    <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                        <label class="form-check-label">
                            <input class="form-check-input" name="remember"
                                   type="checkbox" >
                            <span style="padding-bottom: .15rem">Remember me</span>
                        </label>
                    </div>
                </div>
            </div> -->
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success" name="connexion"><i class="fa fa-sign-in"></i> Se connecter</button>
                    <!-- <a class="btn btn-link" href="/password/reset">Forgot Your Password?</a> -->
                </div>
            </div>
        </form>
    </div>
</body>
</html>