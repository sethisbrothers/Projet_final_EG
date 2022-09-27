<?php
//getting and display author into the database
if(isset($_GET['edit_author'])){
    $edit_author=$_GET['edit_author'];

    $get_author="select * from `author` where author_id = $edit_author";
    $result=mysqli_query($con,$get_author);
    $row=mysqli_fetch_assoc($result);
    $author_name=$row['author_name'];
}
?>


<div class="container mt-3">
    <h1 class="text-center">Modifier Un Auteur</h1>
    <form method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="author_name" class="form-label">Nom de l'Auteur</label>
            <input type="text" name="author_name" id="author_name"  value="<?php echo $author_name?>"class="form-control" required>
        </div>
        <input type="submit" value="Modifier" name="edit_author" class="btn btn-info px-3 mb-3">
    </form>
</div>

<?php
if(isset($_POST['edit_author'])){
    $author_name=$_POST['author_name'];
    $update_query="update `author` set author_name='$author_name' where author_id=$edit_author";
    $result_author=mysqli_query($con,$update_query);
    if($result_author){
        echo "<script>alert('Modification Effectuée')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
?>