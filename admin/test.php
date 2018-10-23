<?php require 'inc/connexion.php'; ?>
<?php require 'inc/acces_admin.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
        //requête pour une seule info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
    <link rel="stylesheet" href="css/test_style.css">
</head>
<body>
    <h1>Test</h1>
    <p><?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom']; ?></p>
    <hr>
    <?php 
            //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_loisirs ");
            $sql->execute();
            $nbr_loisirs = $sql->rowCount();
    ?>
        <h5>Il y a <?php echo $nbr_loisirs; ?> loisirs</h5>
            <ul>
        <?php
                while($ligne_loisir=$sql->fetch())
                {
        ?>
                <li><?php echo $ligne_loisir['loisir']; ?></li>
        <?php 
            } //ferme le while
        ?>
            </ul>
</body>
</html>