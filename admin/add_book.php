    <?php
        include('../includes/connect.php');
        
    if(isset($_POST['insert_book'])){

        $_book_title=$_POST['book_title'];
        $_book_description=$_POST['book_description'];
        $_book_keyword=$_POST['book_keyword'];
        $_book_category=$_POST['book_category'];
        $_author_name=$_POST['author_name'];
        $_book_price=$_POST['book_price'];
        $_book_status='true';

        // accessing images
        $_book_image=$_FILES['book_image']['name'];

        // accessing image tmp name
        $_temp_image=$_FILES['book_image']['tmp_name'];

        //checking empty condition
        if($_book_title=='' or $_book_description=='' or $_book_keyword=='' or $_book_category=='' or $_author_name=='' or $_book_price=='' or $_book_image==''){
            echo"<script>alert('Remplir tous les champs')</script>";
            exit();
        }else{
            move_uploaded_file($_temp_image,"./book_images/$_book_image");

            //insert query
            $insert_books="insert into `books` (book_title,book_description,book_keyword,category_id,author_id,book_image,book_price,date,status) values ('$_book_title','$_book_description','$_book_keyword','$_book_category','$_author_name','$_book_image','$_book_price',NOW(),'$_book_status')";
            $result_query=mysqli_query($con,$insert_books);
            if($result_query){
                echo "<script>alert('Le Livre a été bien Enrégistré')</script>";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel - Ajout d'un livre</title>
        
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <!-- style css link -->
    <link rel="stylesheet" href="style.css">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <body>

        <div class="container mt-3">
            <h1 class="text-center">Ajouter un Livre</h1>
        </div>

        <!-- form -->
    <form method="post" enctype="multipart/form-data">

        <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_title" class="form-label">Titre du Livre</label>
                <input type="text" name="book_title" id="book_title" placeholder="Entrer le Titre du livre"class="form-control" autocomplete="off" required>
            </div>

        <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_description" class="form-label">Description du Livre</label>
                <input type="text" name="book_description" id="book_description" placeholder="Entrer la description du livre"class="form-control" autocomplete="off" required>
            </div>

        <!-- book_keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_keyword" class="form-label">La clé du Livre</label>
                <input type="text" name="book_keyword" id="book_keyword" placeholder="Entrer la clé du livre"class="form-control" autocomplete="off" required>
            </div>

        <!-- category -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="book_category" class="form-select">
                    <option>Choisir la Catégorie</option>

                    <!-- Take and Display the data from table -->
                        <?php
                            $select_query="select * from `category`";
                            $result_query=mysqli_query($con,$select_query);
                            while($row=mysqli_fetch_assoc($result_query)){
                                $category_title=$row['category_title'];
                                $category_id=$row['category_id'];
                                echo "<option value='$category_id'>$category_title</option>";
                            }
                        ?>
                </select>
            </div>

        <!-- Author -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="author_name" class="form-select">
                    <option>Choisir l'Auteur</option>

                <!-- Take and Display the data from table -->
                    <?php
                        $select_query="select * from `author`";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $author_name=$row['author_name'];
                            $author_id=$row['author_id'];
                            echo "<option value='$author_id'>$author_name</option>";
                        }
                    ?>
                </select>
            </div>

        <!-- Image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_image" class="form-label">L'image du Livre</label>
                <input type="file" name="book_image" class="form-control" required>
            </div>
    
        <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_price" class="form-label">Le Prix du Livre</label>
                <input type="text" name="book_price" id="book_price" placeholder="Entrer le prix du livre"class="form-control" autocomplete="off" required>
            </div> 
    
        <!-- Add Product -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_book" class="btn btn-info mb-3 px-3" value="Ajouter un Livre">
            </div>

    </form>

        <!-- footer -->

    <footer>
        <?php

            include('../includes/footer.php');

        ?>
    </footer>

        <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        
    </body>
    </html>
    

