<?php 

include('../includes/connect.php');
include('../functions/common_function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-Registration</title>

    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <!-- style css link -->
    <link rel="stylesheet" href="style.css">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <div class="container-fluid my-3">
        <h2 class="text-center">Nouveau Utilisateur</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="lg-12 col-xl-6">
                <form method="post" enctype="multipart/form-data">

                    <!-- name field -->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">Nom</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Entrez votre Nom d'utilisateur" autocomplete="off" required>
                    </div>
                    <!-- email field -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Entrez votre email" autocomplete="off" required>
                    </div>
                    <!-- image field -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">Image</label>
                        <input type="file" id="user_image" name="user_image" class="form-control">
                    </div>
                    <!-- Password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Mot de Passe</label>
                        <input type="password" id="user_password" name="user_password" class="form-control" placeholder="Entrez votre Mot de Passe" autocomplete="off" required>
                    </div>
                    <!-- Confirmation password field -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirmez Votre Mot de Passe</label>
                        <input type="password" id="conf_user_password" name="conf_user_password" class="form-control" placeholder="Ressaisir votre mot de passe" autocomplete="off" required>
                    </div>
                    <!-- Address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Adresse</label>
                        <input type="text" id="user_address" name="user_address" class="form-control" placeholder="Entrez votre Adresse" autocomplete="off" required>
                    </div>
                    <!-- contact field -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" name="user_contact" class="form-control" placeholder="Entrez votre Numéro de Téléphone" autocomplete="off" required>
                    </div>
                    <div class="d-flex mt-4 pt-2">
                        <input type="submit" value="S'inscrire" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Vous n'avez pas de Compte ? <a class="text-danger" href="user_login.php"> Se connecter</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>


<!-- Put new register in database -->

<?php
    if(isset($_POST['user_register'])){
        $user_name=$_POST['user_name'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
        $conf_user_password=$_POST['conf_user_password'];
        $user_address=$_POST['user_address'];
        $user_contact=$_POST['user_contact'];

        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        //get ip of user
        $user_ip=getIPAddress();
        //select_query
        $select_query="select * from `user_table` where user_name='$user_name' or user_email='$user_email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
            echo "<script>alert('Ce nom et email est déjà utilisé')</script>";
        }else if($user_password!=$conf_user_password){
            echo "<script>alert('mot de passe non identique')</script>";
        }
        else{
            //insert into user table on my database
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $insert_query="insert into `user_table` (user_name,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ('$user_name','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
        $sql_execute=mysqli_query($con,$insert_query);
        }

        //selecting cart items
        $select_cart_items="select *from `cart_details` where ip_address='$user_ip'";
        $result_cart=mysqli_query($con,$select_cart_items);
        $rows_count=mysqli_num_rows($result_cart);
        if($rows_count>0){
            $_SESSION['username']=$user_name;
            echo "<script>alert('Bienvenue')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
        else{
            echo "<script>window.open('user_login.php','_self')</script>";
        }
    }
?>