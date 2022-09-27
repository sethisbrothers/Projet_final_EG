<?php

// connect file

include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>

    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <!-- style css link -->
    <link rel="stylesheet" href="style.css">

    <style>
        .cart_img{
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>

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
                <img src="./images/logo.png" alt="book open" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Livres</a>
                        </li>
                        <?php
                        if(isset($_SESSION['username'])){
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='./user/profile.php'>Mon Compte</a>
                                </li>";
                        }else{
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='./user/user_registration.php'>S'inscrire</a>
                                </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"> <i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i> </a>
                        </li>
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
                                    <a class='nav-link' href='./user/logout.php'>Se Déconnecter</a>
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

        <!-- cart details part -->
        <div class="container">
            <div class="row">
                <form action="" method="post">

                    <table class="table table-bordered text-center">
                        
                            <!-- Display dynamic data -->
                            <?php
                                
                                    $get_ip_add = getIPAddress();
                                    $total_price=0;
                                    $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
                                    $result=mysqli_query($con,$cart_query);
                                    $result_count=mysqli_num_rows($result);

                                    //condition to display shopping bag is empty
                                    if($result_count>0){

                                        echo"<thead>
                                                <tr>
                                                    <th>Titre des Livres</th>
                                                    <th>Image des Livres</th>
                                                    <th>Quantité</th>
                                                    <th>Prix Total</th>
                                                    <th>Choix</th>
                                                    <th colspan='2'>Action</th>
                                                </tr>
                                            </thead>
                                    <tbody>";

                                 
                                            while($row=mysqli_fetch_array($result)){
                                                $book_id=$row['book_id'];
                                                $select_book="select * from `books` where book_id='$book_id'";
                                                $result_book=mysqli_query($con,$select_book);
                                                    while($row_book_price=mysqli_fetch_array($result_book)){
                                                        $book_price=array($row_book_price['book_price']);
                                                        $price_table=$row_book_price['book_price'];
                                                        $book_title=$row_book_price['book_title'];
                                                        $book_image=$row_book_price['book_image'];
                                                        $book_values=array_sum($book_price);
                                                        $total_price+=$book_values;
                                        
                                            ?>
                                                            <tr>
                                                                <td><?php echo $book_title ?></td>
                                                                <td> <img src="./admin/book_images/<?php echo $book_image ?>" class="cart_img"> </td>
                                                                <td> <input type="text" name="qty" classs="form-input w-50"> </td>

                                                                <?php
                                                                $get_ip_add = getIPAddress();
                                                                if(isset($_POST['update_cart'])){
                                                                    $quantities=$_POST['qty'];
                                                                    $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
                                                                    $result_book_quantity=mysqli_query($con,$update_cart);
                                                                    $total_price=$total_price*$quantities;
                                                                }
                                                                ?>
                                                
                                                                <td><?php echo $price_table ?>F CFA</td>
                                                                <td> <input type="checkbox" name="removeitem[]" value="<?php echo $book_id ?>"> </td>
                                                                <td>
                                                                    <input type="submit" name="update_cart" class="bg-info px-3 py-2 mx-3 border-0" value="Modifiez votre panier">
                                                                    <input type="submit" name="remove_cart" class="bg-info px-3 py-2 mx-3 border-0" value="Supprimez ce Livre">
                                                                </td>
                                                            </tr>
                                            <?php
                                            }
                                        } } 
                                        else{
                                            echo "<h2 class='text-center text-danger'>Votre Panier est Vide !</h2>";
                                        }
                                        ?>
                                    </tbody>
                    </table>

                            <!-- Total buy -->
                    <div class="d-flex mb-5">

                        <?php
                            $get_ip_add = getIPAddress();
                            $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
                            $result=mysqli_query($con,$cart_query);
                            $result_count=mysqli_num_rows($result);
                            if($result_count>0){
                                echo "
                                <h4 class='px-3'>Total Acheté: <strong class='text-info'>$total_price F CFA</strong></h4>
                                <input type='submit' value='Retour aux livres' class='bg-info px-3 py-2 mx-3 border-0' name='Continue_shopping'>
                                <button class='bg-secondary px-3 py-2 mx-3 border-0'><a href='./user/checkout.php' class='text-light text-decoration-none'>Continuer Votre Achat</a></button>";
                            }else{
                                echo "<input type='submit' value='Retour aux livres' class='bg-info px-3 py-2 mx-3 border-0' name='Continue_shopping'>";
                            }
                            if(isset($_POST['Continue_shopping'])){
                                echo "<script>window.open('index.php','_self')</script>";
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </form>

    </div>

    <!-- function to remove item -->
    <?php
            function remove_cart_item(){
                global $con;
                if(isset($_POST['remove_cart'])){
                    foreach($_POST['removeitem'] as $remove_id){
                        echo $remove_id;
                        $delete_query="Delete from `cart_details` where book_id=$remove_id";
                        $run_delete=mysqli_query($con,$delete_query);
                        if($run_delete){
                            echo "<script>window.open('cart.php','_self')</script>";
                        }
                    }
                }
            }

            echo $remove_item=remove_cart_item();
            ?>

    
<!-- footer -->
    <?php

        include('./includes/footer.php');

    ?>

    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>