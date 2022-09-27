<!--get data from the database-->

<?php
if(isset($_GET['edit_book'])){
    $edit_id=$_GET['edit_book'];

    //geeting all data on books database
    $get_data="select * from `books` where book_id=$edit_id";
    $result=mysqli_query($con,$get_data);
    $row=mysqli_fetch_assoc($result);
    $book_title=$row['book_title'];
    $book_description=$row['book_description'];
    $book_keyword=$row['book_keyword'];
    $category_id=$row['category_id'];
    $author_id=$row['author_id'];
    $book_image=$row['book_image'];
    $book_price=$row['book_price'];

    //fetching category title on database category
    $select_category="select * from `category` where category_id=$category_id";
    $result_category=mysqli_query($con,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $category_title=$row_category['category_title'];

 
    //fetching author title on database category
    $select_author="select * from `author` where author_id=$author_id";
    $result_author=mysqli_query($con,$select_author);
    $row_author=mysqli_fetch_assoc($result_author);
    $author_name=$row_author['author_name']; 

}
?>


<div class="container mt-5">
    <h1 class="text-center">Modifier Un Livre</h1>
    <form method="post" enctype="multipart/form-data">

        <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_title" class="form-label">Titre du Livre</label>
                <input type="text" name="book_title" id="book_title" placeholder="Entrer le Titre du livre"class="form-control" value="<?php echo $book_title ?>" required>
            </div>

        <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_description" class="form-label">Description du Livre</label>
                <input type="text" name="book_description" id="book_description" placeholder="Entrer la description du livre"class="form-control" value="<?php echo $book_description ?>" required>
            </div>

        <!-- book_keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_keyword" class="form-label">La clé du Livre</label>
                <input type="text" name="book_keyword" id="book_keyword" placeholder="Entrer la clé du livre"class="form-control" value="<?php echo $book_keyword ?>" required>
            </div>

        <!-- category -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="book_category" class="form-select">
                    <option value="<?php echo $category_title ?>"> <?php echo $category_title ?></option>

                    <!-- Take and Display the data from table -->
                        <?php
                            $select_category_all="select * from `category`";
                            $result_category_all=mysqli_query($con,$select_category_all);
                            while($row_category_all=mysqli_fetch_assoc($result_category_all)){
                                $category_title=$row_category_all['category_title'];
                                $category_id=$row_category_all['category_id'];
                                echo "<option value='$category_id'>$category_title</option>";
                            }
                        ?>
                </select>
            </div>

        <!-- Author -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="author_name" class="form-select">
                    <option value="<?php echo $author_name ?>"><?php echo $author_name ?></option>

                <!-- Take and Display the data from table -->
                    <?php
                        $select_author_all="select * from `author`";
                        $result_author_all=mysqli_query($con,$select_author_all);
                        while($row_author_all=mysqli_fetch_assoc($result_author_all)){
                            $author_name=$row_author_all['author_name'];
                            $author_id=$row_author_all['author_id'];
                            echo "<option value='$author_id'>$author_name</option>";
                        }
                    ?>
                </select>
            </div>

        <!-- Image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_image" class="form-label">L'image du Livre</label>
                <div class="d-flex">
                    <input type="file" name="book_image" class="form-control w-90 m-auto" required>
                    <img src="./book_images/<?php echo $book_image ?>" alt="<?php echo $book_image ?>" class="book_image">
                </div>
            </div>
    
        <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_price" class="form-label">Le Prix du Livre</label>
                <input type="text" name="book_price" id="book_price" placeholder="Entrer le prix du livre"class="form-control" value="<?php echo $book_price ?>" required>
            </div> 
    
        <!-- Add Product -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="edit_book" class="btn btn-info mb-3 px-3" value="Modifier un Livre">
            </div>

    </form>
</div>

<!--Editing books-->
<?php

//put the data on the database

if(isset($_POST['edit_book'])){
    $book_title=$_POST['book_title'];
    $book_description=$_POST['book_description'];
    $book_keyword=$_POST['book_keyword'];
    $book_category=$_POST['book_category'];
    $book_author=$_POST['author_name'];
    $book_image=$_FILES['book_image']['name'];
    $book_image_tmp=$_FILES['book_image']['tmp_name'];
    $book_price=$_POST['book_price'];

    //checking empty condition
    if($book_title=='' or $book_description=='' or $book_keyword=='' or $book_category=='' or $author_name=='' or $book_price=='' or $book_image==''){
        echo"<script>alert('Remplir tous les champs')</script>";
    }else{
        move_uploaded_file($book_image_tmp,"./book_images/$book_image");

        //query to update book
        $update_book="update `books` set book_title='$book_title',book_description='$book_description',book_keyword='$book_keyword',category_id='$book_category',author_id='$book_author',book_image='$book_image',book_price='$book_price',date=NOW() where book_id=$edit_id";
        $result_update=mysqli_query($con,$update_book);
        if($result_update){
            echo "<script>alert('Modification Reussie')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
   
}

?>