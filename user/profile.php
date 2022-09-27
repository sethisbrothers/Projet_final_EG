<?php

// connect file

include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue <?php echo $_SESSION['username']?></title>

    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <!-- style css link -->
    <link rel="stylesheet" href="../style.css">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
        <!-- navbar -->
    <div class="container-fluid p-0">

    <!-- header -->

    <!-- first header -->

        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="book open" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Livres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mon Compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"> <i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Prix Total: <?php total_cart_price();  ?>F CFA</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_book.php" method="get">
                        <input class="form-control me-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
                        <input type="submit" value="search" name="search_data_book" class="btn btn-outline-secondary">
                    </form>
                </div>
            </div>
        </nav>

        <!-- Second header -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php

                    if(!isset($_SESSION['username'])){
                        echo"<li class='nav-item'>
                                <a class='nav-link' href='#'>Bienvenue Invité</a>
                            </li>";
                    }else{
                        echo"<li class='nav-item'>
                                <a class='nav-link' href='#'>Bienvenue ".$_SESSION['username']."</a>
                            </li>";
                        }
                        if(!isset($_SESSION['username'])){
                            echo"<li class='nav-item'>
                                    <a class='nav-link' href='./user/user_login.php'>Se connecter</a>
                                </li>";
                        }else{
                            echo"<li class='nav-item'>
                                    <a class='nav-link' href='logout.php'>Se Déconnecter</a>
                                </li>";
                        }
                ?>
            </ul>
        </nav>

        <!-- third header -->
        <div class="bg-light">
            <h3 class="text-center">Livres</h3>
            <p class="text-center">Meilleur site de vente de livres au Togo</p>
        </div>

        <!-- four header -->
        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center profil_nav">
                    <li class="nav-item bg-info">
                        <a class="nav-link text-light" href="profile.php"> <h2>Votre Profil</h2></a>
                    </li>
                    <?php
                    //getting image for the user in the database and display on the profile page
                    $username=$_SESSION['username'];
                    $user_image="select * from `user_table` where user_name='$username'";
                    $result_image=mysqli_query($con,$user_image);
                    $row_image=mysqli_fetch_array($result_image);
                    $user_image=$row_image['user_image'];
                    echo "
                            <li class='nav-item'>
                                <img src='./user_images/$user_image' class='porfil_image my-4' alt='$username'>
                            </li>
                    ";
                    ?>
                    
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php">Paiement En Attente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?edit_account">Editer son Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?my_orders">Mes commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?delete_account">Supprimer Mon Compte</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link text-light" href="logout.php">Se Déconnecter</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php
                    get_user_order_details();
                    if(isset($_GET['edit_account'])){
                        include('edit_account.php');
                    }
                    if(isset($_GET['my_orders'])){
                        include('user_orders.php');
                    }
                    if(isset($_GET['delete_account'])){
                        include('delete_account.php');
                    }
                ?>
            </div>
        </div>

    </div>

    
<!-- footer -->
    <?php

        include('../includes/footer.php');

    ?>

    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>