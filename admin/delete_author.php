<?php
if(isset($_GET['delete_author'])){
    $delete_author=$_GET['delete_author'];

    $delete_query="delete from `author` where author_id=$delete_author";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Suppression Réussie')</script>";
        echo "<script>window.open('./index.php?view_author','_self')</script>";
    }
}

?>

