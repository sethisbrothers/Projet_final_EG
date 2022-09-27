<?php
if(isset($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    $select_query="select * from `user_table` where user_name='$user_session_name'";
    $result_query=mysqli_query($con,$select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $user_name=$row_fetch['user_name'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
}
    //update the user profile on database
    if(isset($_POST['user_update'])){
        $update_id=$user_id;
        $user_name=$_POST['user_name'];
        $user_email=$_POST['user_email'];
        $user_address=$_POST['user_address'];
        $user_mobile=$_POST['user_mobile'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];

        //move image to the path
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");

        //update querry
        $update_data="update `user_table` set user_name='$user_name',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_mobile='$user_mobile'";
        $result_query_update=mysqli_query($con,$update_data);
        if($result_query_update){
            echo "<script>alert('Mise à jour Effectué avec succes')</script>";
            echo "<script>window.open('logout.php','_self')</script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="mb-4 text-dark">Editer Votre Compte</h3>
    <form method="post" enctype=multipart/form-data>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_name?>" name="user_name">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email?>" name="user_email">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <img src="./user_images/<?php echo $user_image?>" alt="<?php echo $user_name?>" class="edit_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile?>" name="user_mobile">
        </div>

        <input type="submit" value="Modifier" class="bg-info py-2 px-3 border-0" name="user_update">
    </form>
</body>
</html>