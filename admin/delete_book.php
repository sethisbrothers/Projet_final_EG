<?php

if(isset($_GET['delete_book'])){
    $delete_id=$_GET['delete_book'];

    //deleted query

    $delete_book="delete from `books` where book_id=$delete_id";
    $result_book=mysqli_query($con,$delete_book);
    if($result_book){
        echo "<script>alert('Suppression Reussie')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}

?>