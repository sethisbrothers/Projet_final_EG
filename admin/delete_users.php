<?php
if(isset($_GET['delete_users'])){
    $delete_users=$_GET['delete_users'];

    $delete_query="delete from `user_table` where user_id=$delete_users";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Suppression Réussie')</script>";
        echo "<script>window.open('./index.php?view_users','_self')</script>";
    }
}

?>