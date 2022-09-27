<?php 

include('../includes/connect.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">
            Inscription de l'Admnistrateur
        </h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/pexels-alina-vilchenko-2099266.jpg" alt="Book open" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form method="post">
                    <div class="form-outline mb-4">
                        <label for="admin_name" class="form-label">Admin Name</label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Entrer votre Nom"  class="form-control" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="admin_email" class="form-label">Email</label>
                        <input type="email" id="admin_email" name="admin_email" placeholder="Entrer votre email"  class="form-control" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="admin_password" class="form-label">Mot de Passe</label>
                        <input type="password" id="admin_password" name="admin_password" placeholder="Entrer votre Mot de passe"  class="form-control" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="admin_conf_password" class="form-label">Confirmer Votre Mot de Passe</label>
                        <input type="password" id="admin_conf_password" name="admin_conf_password" placeholder="Confirmer votre mot de passe"  class="form-control" required>
                    </div>
                    <div>
                        <input type="submit" name="admin_registration" value="s'inscrire" class="bg-info py-2 px-3 border-0" required>
                        <p class="small fw-bold mt-2 pt-1"> Vous avez déja un Compte Admin ? <a href="admin_login.php" class="link-success text-decoration-none">Se Connecter</a> </p>
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
    if(isset($_POST['admin_registration'])){
        $admin_name=$_POST['admin_name'];
        $admin_email=$_POST['admin_email'];
        $admin_password=$_POST['admin_password'];
        $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
        $admin_conf_password=$_POST['admin_conf_password'];

        //select_query
        $select_query="select * from `admin_table` where admin_name='$admin_name' or admin_email='$admin_email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
            echo "<script>alert('Ce nom et email est déjà utilisé')</script>";
        }else if($admin_password!=$admin_conf_password){
            echo "<script>alert('mot de passe non identique')</script>";
        }
        else{
            //insert into user table on my database
        
        $insert_query="insert into `admin_table` (admin_name,admin_email,admin_password) values ('$admin_name','$admin_email','$hash_password')";
        $sql_execute=mysqli_query($con,$insert_query);

        echo "<script>alert('Inscription Effectué avec succès')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        }

    }
?>