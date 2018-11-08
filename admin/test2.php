<?php require 'inc/connexion.php'; ?>
<?php require 'inc/acces_admin.php';  
require 'inc/head.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>test</title>
     
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>

    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="profil.php">Mon CV</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <a class="nav-link" href="#"> <i class="fas fa-door-open"></i></a>
            </li>
        </ul>
        </nav>

        <div class="container-fluid">
        <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="competences.php">
                                <span data-feather="file"></span>
                                Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="loisirs.php">
                                <span data-feather="shopping-cart"></span>
                                Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="formations.php">
                                <span data-feather="users"></span>
                                Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="experiences.php">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="reseaux.php">
                                <span data-feather="layers"></span>
                                Integrations
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Section title</h2>
                    <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>1,001</td>
                                    <td>Lorem</td>
                                    <td>ipsum</td>
                                    <td>dolor</td>
                                    <td>sit</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </main>
            </div> 
        </div>
                

















        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="../../assets/js/vendor/popper.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>

        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
        feather.replace()
        </script>  
    </body>
</html>