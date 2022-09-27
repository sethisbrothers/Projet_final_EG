<?php


//getting or display all books
function getbooks(){
    global $con;
    
    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['author'])){

        $select_query="select * from `books` order by rand()  LIMIT 0,4";
        $result_query=mysqli_query($con,$select_query);
        while($row=mysqli_fetch_assoc($result_query)){
            $book_id=$row['book_id'];
            $book_title=$row['book_title'];
            $book_description=$row['book_description'];
            $book_image=$row['book_image'];
            $book_price=$row['book_price'];
            $category_id=$row['category_id'];
            $author_id=$row['author_id'];

            echo "
                <div class='col-md-3 mb-2'>
                    <div class='card'>
                        <img src='./admin/book_images/$book_image' class='card-img-top' alt='$book_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$book_title</h5>
                            <p class='card-text'>$book_description</p>
                            <h6 class='card-text text-center'>Prix: $book_price F CFA</h6>
                            <div class='text-center'>
                                <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }       
        } 
    }  

}
// <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>Voir Plus</a>

//get all books
function get_all_books(){
    global $con;
    
    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['author'])){
        $select_query="select * from `books` order by rand()";
        $result_query=mysqli_query($con,$select_query);
        while($row=mysqli_fetch_assoc($result_query)){
            $book_id=$row['book_id'];
            $book_title=$row['book_title'];
            $book_description=$row['book_description'];
            $book_image=$row['book_image'];
            $book_price=$row['book_price'];
            $category_id=$row['category_id'];
            $author_id=$row['author_id'];

            echo "
                <div class='col-md-3 mb-2'>
                    <div class='card'>
                        <img src='./admin/book_images/$book_image' class='card-img-top' alt='$book_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$book_title</h5>
                            <p class='card-text'>$book_description</p>
                            <h6 class='card-text text-center'>Prix: $book_price F CFA</h6>
                            <div class='text-center'>
                                <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
        }   
    }
}
// <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>Voir Plus</a>
//getting unique category
function get_unique_category(){
    global $con;
    
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
        $select_query="select * from `books` where category_id=$category_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'>Pas de livre disponible pour ce catégorie</h2>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
            $book_id=$row['book_id'];
            $book_title=$row['book_title'];
            $book_description=$row['book_description'];
            $book_image=$row['book_image'];
            $book_price=$row['book_price'];
            $category_id=$row['category_id'];
            $author_id=$row['author_id'];

            echo "
                <div class='col-md-3 mb-2'>
                    <div class='card'>
                        <img src='./admin/book_images/$book_image' class='card-img-top' alt='$book_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$book_title</h5>
                            <p class='card-text'>$book_description</p>
                            <h6 class='card-text text-center'>Prix: $book_price F CFA</h6>
                            <div class='text-center'>
                                <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            
        }   
    }
}

// <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>Voir Plus</a>
//getting unique category
function get_unique_author(){
    global $con;
    
    if(isset($_GET['author'])){
        $author_id=$_GET['author'];
        $select_query="select * from `books` where author_id=$author_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'>Pas de livre disponible pour cet auteur</h2>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
            $book_id=$row['book_id'];
            $book_title=$row['book_title'];
            $book_description=$row['book_description'];
            $book_image=$row['book_image'];
            $book_price=$row['book_price'];
            $category_id=$row['category_id'];
            $author_id=$row['author_id'];

            echo "
                <div class='col-md-3 mb-2'>
                    <div class='card'>
                        <img src='./admin/book_images/$book_image' class='card-img-top' alt='$book_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$book_title</h5>
                            <p class='card-text'>$book_description</p>
                            <h6 class='card-text text-center'>Prix: $book_price F CFA</h6>
                            <div class='text-center'>
                                <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            
        }   
    }
}
// <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>Voir Plus</a>

//Displaying Author in sidenav
function getauthor(){
    global $con;
    $select_author="select * from `author`";
    $result_author=mysqli_query($con,$select_author);
    while($row_data=mysqli_fetch_assoc($result_author)){
        $author_name=$row_data['author_name'];
        $author_id=$row_data['author_id'];
        echo "  <li class='nav-item'>
                    <a href='index.php?=$author_id' class='nav-link text-light'>$author_name</a>
                </li>";
    }
}

//Display Category in sidenav
function getcategory(){
    global $con;
    $select_category="select * from `category`";
    $result_category=mysqli_query($con,$select_category);
    while($row_data=mysqli_fetch_assoc($result_category)){
        $category_title=$row_data['category_title'];
        $category_id=$row_data['category_id'];
        echo "  <li class='nav-item'>
                    <a href='index.php?=$category_id' class='nav-link text-light'>$category_title</a>
                </li>";
    }
}

//get search book function

function search_book(){
    global $con;
    if(isset($_GET['search_data_book'])){
        $search_data_value=$_GET['search_data'];
        $search_query="select * from `books` where book_keyword like '%$search_data_value%'";
        $result_query=mysqli_query($con,$search_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'> Le Livre que vous cherchez n'est pas disponible !</h2>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
            $book_id=$row['book_id'];
            $book_title=$row['book_title'];
            $book_description=$row['book_description'];
            $book_image=$row['book_image'];
            $book_price=$row['book_price'];
            $category_id=$row['category_id'];
            $author_id=$row['author_id'];

            echo "
                <div class='col-md-3 mb-2'>
                    <div class='card'>
                        <img src='./admin/book_images/$book_image' class='card-img-top' alt='$book_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$book_title</h5>
                            <p class='card-text'>$book_description</p>
                            <h6 class='card-text text-center'>Prix: $book_price F CFA</h6>
                            <div class='text-center'>
                                <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
        }
    }

    // <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>Voir Plus</a>

// get ip address function
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
} 


//cart function
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_add = getIPAddress();
        $get_book_id=$_GET['add_to_cart'];
        $select_query="select * from `cart_details` where ip_address='$get_ip_add' and book_id=$get_book_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows>0){
            echo "<script>alert('ce livre est déjà présent dans le panier')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }else{
            $insert_query="insert into `cart_details` (book_id,ip_address,quantity) values ($get_book_id,'$get_ip_add',0)";
            $result_query=mysqli_query($con,$insert_query);
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}


//function to get cart number
function cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_add = getIPAddress();
        $select_query="select * from `cart_details` where ip_address='$get_ip_add'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
        }else{
            global $con;
            $get_ip_add = getIPAddress();
            $select_query="select * from `cart_details` where ip_address='$get_ip_add'";
            $result_query=mysqli_query($con,$select_query);
            $count_cart_items=mysqli_num_rows($result_query);
        }
    echo $count_cart_items;
}

//total price function
function total_cart_price(){
    global $con;
    $get_ip_add = getIPAddress();
    $total_price=0;
    $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
    $result=mysqli_query($con,$cart_query);
    while($row=mysqli_fetch_array($result)){
        $book_id=$row['book_id'];
        $select_book="select * from `books` where book_id='$book_id'";
        $result_book=mysqli_query($con,$select_book);
        while($row_book_price=mysqli_fetch_array($result_book)){
            $book_price=array($row_book_price['book_price']);
            $book_values=array_sum($book_price);
            $total_price+=$book_values;
        }
    }
echo $total_price;
}

//get user order details
function get_user_order_details(){
    global $con;
    $username=$_SESSION['username'];
    $get_details="select * from `user_table` where user_name='$username'";
    $result_query_details=mysqli_query($con,$get_details);
    while($row_query=mysqli_fetch_array($result_query_details)){
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders="select * from `user_orders` where user_id=$user_id and order_status='pending'";
                    $result_orders_query=mysqli_query($con,$get_orders);
                    $row_count=mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo "<h3 class='text-center text-dark my-5'> Vous Avez <span class='text-danger'>$row_count</span> commandes en Attente</h3>
                        <p class='text-center text-info text-decoration-none'><a href='profile.php?my_orders'>Détails des Commandes</a></p>";
                    }else{
                        echo "<h3 class='text-center text-dark my-5'> Vous Avez Zero commande en Attente</h3>
                        <p class='text-center text-primary text-decoration-none'><a href='../index.php'>Parcourir les livres</a></p>";
                    }
                }
            }
        }
    }
}
?>