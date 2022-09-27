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
    <title>Admin Dashboard</title>
    
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    
    <!-- style css link -->
    <link rel="stylesheet" href="../style.css">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
    /*Admin admin_panel*/
        .admin_image{       
            width: 100px;
            object-fit: contain;
        }
        .book_image{       
            width: 50px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    
<!-- navbar -->
<div class="container-fluid p-0">

 <!-- header -->
    <!-- first head -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="../images/logo.png" alt="book open" class="logo">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <?php

                        if(isset($_SESSION['admin_name'])){
                            echo"<li class='nav-item'>
                                    <a class='nav-link' href='#'>Bienvenue ".$_SESSION['admin_name']."</a>
                                </li>";
                            }
                            if(isset($_SESSION['admin_name'])){
                                echo"<li class='nav-item'>
                                        <a class='nav-link' href='logout.php'>Se Déconnecter</a>
                                    </li>";
                            }
                    ?>
                </ul>
            </nav>
        </div>
    </nav>

    <!-- second head -->
    <div class="bg-light">
        <h3 class="text-center p-2">
            Administrateur Panel
        </h3>
    </div>

    <!-- third head -->
    <div class="row">
        <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
            <div class="logo-left p-3">
                <a href="#"><img src="../images/admin.png" alt="Admin photo" class="admin_image"></a>
                <p class="text-light text-center"><?php echo $_SESSION['admin_name'] ;?></p>
            </div>
            <div class="button text-center">
                <button class="my-3"><a href="add_book.php" class="nav-link text-light bg-info my-1">Ajouter des livres</a></button>
                <button><a href="admin_panel.php?view_books" class="nav-link text-light bg-info my-1">Afficher les livres</a></button>
                <button><a href="admin_panel.php?Add_author" class="nav-link text-light bg-info my-1">Ajouter des Auteurs</a></button>
                <button><a href="admin_panel.php?view_author" class="nav-link text-light bg-info my-1">Afficher les Auteurs</a></button>
                <button><a href="admin_panel.php?Add_category" class="nav-link text-light bg-info my-1">Ajouter des Catégories</a></button>
                <button><a href="admin_panel.php?view_category" class="nav-link text-light bg-info my-1">Afficher les Catégories</a></button>
                <button><a href="admin_panel.php?view_orders" class="nav-link text-light bg-info my-1">Afficher les Commandes</a></button>
                <button><a href="admin_panel.php?view_payments" class="nav-link text-light bg-info my-1">Afficher les Paiements</a></button>
                <button><a href="admin_panel.php?view_users" class="nav-link text-light bg-info my-1">Afficher les Utilisateurs</a></button>
                <button><a href="logout.php" class="nav-link text-light bg-info my-1">Se Déconnecter</a></button>
            </div>
        </div>
    </div>

    <!--Insert the php file to another page on admin_panel page-->
    <div class="container my-3">

        <!-- Active the variable link to bring th file.php -->
        <?php

        //Add part
            if(isset($_GET['Add_category'])){
                include('add_category.php');
            }
            if(isset($_GET['Add_author'])){
                include('add_author.php');
            }

            // delete part
            if(isset($_GET['delete_book'])){
                include('delete_book.php');
            }
            if(isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if(isset($_GET['delete_author'])){
                include('delete_author.php');
            }
            if(isset($_GET['delete_orders'])){
                include('delete_orders.php');
            }
            if(isset($_GET['delete_payments'])){
                include('delete_payments.php');
            }
            if(isset($_GET['delete_users'])){
                include('delete_users.php');
            }

            //Edit part
            
            if(isset($_GET['edit_book'])){
                include('edit_book.php');
            }
            if(isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if(isset($_GET['edit_author'])){
                include('edit_author.php');
            }
            //View part
            if(isset($_GET['view_books'])){
                include('view_books.php');
            }
            if(isset($_GET['view_category'])){
                include('view_category.php');
            }
            if(isset($_GET['view_author'])){
                include('view_author.php');
            }
            if(isset($_GET['view_orders'])){
                include('view_orders.php');
            }
            if(isset($_GET['view_payments'])){
                include('view_payments.php');
            }
            if(isset($_GET['view_users'])){
                include('view_users.php');
            }
            
            
        ?>
    </div>

</div>


    <!-- footer -->

    <footer>
        <?php

            include('../includes/footer.php');

        ?>
    </footer>
    
    

<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<!-- bootstrap link for the pop message -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>