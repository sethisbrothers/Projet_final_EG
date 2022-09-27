<?php
include('../includes/connect.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">
            Portail Administrateur
        </h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/pexels-janko-ferlic-590493.jpg" alt="Book open" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4 mt-10">
                <form method="post">
                    <div class="form-outline mb-4">
                        <label for="admin_name" class="form-label">Nom</label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Entrer votre Nom"  class="form-control" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="admin_password" class="form-label">Mot de Passe</label>
                        <input type="password" id="admin_password" name="admin_password" placeholder="Entrer votre Mot de passe"  class="form-control" required>
                    </div>
                    <div>
                        <input type="submit" name="admin_login" value="se connecter" class="bg-info py-2 px-3 border-0" required>
                        <p class="small fw-bold mt-2 pt-1"> Vous n'avez pas encore un Compte Admin ? <a href="admin_registration.php" class="link-info text-decoration-none">S'inscrire</a> </p>
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
//Checking correct admin, password into admin_table and connect this admin in the session

if(isset($_POST['admin_login'])){
    $admin_name=$_POST['admin_name'];
    $admin_password=$_POST['admin_password'];

    $select_query="select * from `admin_table` where admin_name='$admin_name'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);

    
    if($row_count>0){
        $_SESSION['admin_name']=$admin_name;
        if(password_verify($admin_password,$row_data['admin_password'])){
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['admin_name']=$admin_name;
                echo "<script>alert('Bienvenue $admin_name')</script>";
                echo "<script>window.open('admin_panel.php','_self')</script>";
            }
        }else{
            echo "<script>alert('Ce compte n'existe pas')</script>";
        }
    }else{
        echo "<script>alert('Ce compte n'existe pas')</script>";
    }

}
?>