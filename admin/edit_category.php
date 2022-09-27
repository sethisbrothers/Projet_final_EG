<?php
//getting and display category into the database
if(isset($_GET['edit_category'])){
    $edit_category=$_GET['edit_category'];

    $get_category="select * from `category` where category_id = $edit_category";
    $result=mysqli_query($con,$get_category);
    $row=mysqli_fetch_assoc($result);
    $category_title=$row['category_title'];
}
?>


<div class="container mt-3">
    <h1 class="text-center">Modifier Une Categorie</h1>
    <form method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Titre du Categorie</label>
            <input type="text" name="category_title" id="category_title"  value="<?php echo $category_title?>"class="form-control" required>
        </div>
        <input type="submit" value="Modifier" name="edit_category" class="btn btn-info px-3 mb-3">
    </form>
</div>

<?php
if(isset($_POST['edit_category'])){
    $category_title=$_POST['category_title'];
    $update_query="update `category` set category_title='$category_title' where category_id=$edit_category";
    $result_category=mysqli_query($con,$update_query);
    if($result_category){
        echo "<script>alert('Modification Effectuée')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
?>