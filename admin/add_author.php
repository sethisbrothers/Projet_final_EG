<?php
include('../includes/connect.php');

if(isset($_POST['add_aut'])){
    $_author_name=$_POST['aut_name'];

    //select data from database
    $select_query="select * from `author` where author_name='$_author_name'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo"<script>alert('Cet Auteur existe déjà')</script>";
    }
    else{
    //Insert to the database
        $insert_query="insert into `author` (author_name) values ('$_author_name')";
        $result=mysqli_query($con,$insert_query);
        if($result){
            echo"<script>alert('L'Auteur a été bien Ajoutée')</script>";
        }
    }
   
}

?>

<h2 class="text-center">Ajouter un Auteur</h2>
<form method="post" class="mb-2">
    <div class="input-group mb-2 w-90">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="aut_name" placeholder="Ajouter un Auteur" aria-label="Author" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="border-0 btn p-2 my-3 bg-info" name="add_aut" value="Ajouter un Auteur">
    </div>
</form>