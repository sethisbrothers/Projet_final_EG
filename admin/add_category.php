<?php
include('../includes/connect.php');

if(isset($_POST['add_cat'])){
    $_category_title=$_POST['cat_title'];

    //select data from database
    $select_query="select * from `category` where category_title='$_category_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo"<script>alert('Cette catégorie existe déjà')</script>";
    }
    else{
    //Insert to the database
        $insert_query="insert into `category` (category_title) values ('$_category_title')";
        $result=mysqli_query($con,$insert_query);
        if($result){
            echo"<script>alert('La Catégorie a été bien Ajoutée')</script>";
        }
    }
   
}

?>

<h2 class="text-center">Ajouter une Catégorie</h2>
<form method="post" class="mb-2">
    <div class="input-group mb-2 w-90">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Ajouter un Catégorie de Livre" aria-label="Category" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="border-0 btn p-2 my-3 bg-info" name="add_cat" value="Ajouter un Categorie">
    </div>
</form>