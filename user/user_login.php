<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <style>
        body{
            overflow-x:hidden;
        }
    </style>

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <div class="container-fluid my-3">
        <h2 class="text-center mt-5">Se connecter</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="lg-12 col-xl-6">
                <form method="post">

                    <!-- name field -->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">Nom</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" palceholder="Entrez votre Nom d'utilisateur" autocomplete="off" required>
                    </div>
                    
                    <!-- Password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Mot de Passe</label>
                        <input type="password" id="user_password" name="user_password" class="form-control" palceholder="Entrez votre Mot de Passe" autocomplete="off" required>
                    </div>
                    
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Se connecter" class="bg-info py-2 px-3 mb-2 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-3">Vous n'avez pas de Compte ? <a class="text-danger" href="user_registration.php"> S'inscrire</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>

<?php
//Checking correct user_name, password into user_table and connect this user in the session

if(isset($_POST['user_login'])){
    $user_name=$_POST['user_name'];
    $user_password=$_POST['user_password'];

    $select_query="select * from `user_table` where user_name='$user_name'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    // cart item
    $select_query_cart="select * from `cart_details` where ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $_SESSION['username']=$user_name;
        if(password_verify($user_password,$row_data['user_password'])){
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$user_name;
                echo "<script>alert('Bienvenue $user_name')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }else{
                $_SESSION['username']=$user_name;
                echo "<script>alert('Bienvenue $user_name')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        }else{
            echo "<script>alert('Ce compte n'existe pas')</script>";
        }
    }else{
        echo "<script>alert('Ce compte n'existe pas')</script>";
    }

}
?>