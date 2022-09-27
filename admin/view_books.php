<h2 class="text-center text-success">Tous les Livres</h2>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
    <tr>
            <th>N° d'ordre</th>
            <th>Titre des Livres</th>
            <th>Image des Livres</th>
            <th>Prix des Livres</th>
            <th>Status</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
    <?php
    $get_books="select * from `books`";
    $result=mysqli_query($con,$get_books);
    $number=0;
    while($row=mysqli_fetch_assoc($result)){
        $book_id=$row['book_id'];
        $book_title=$row['book_title'];
        $book_image=$row['book_image'];
        $book_price=$row['book_price'];
        $status=$row['status'];
        $number++;
        ?>  
        <tr class="text-center">
        <td><?php echo $number;?></td>
        <td><?php echo $book_title;?></td>
        <td> <img src="./book_images/<?php echo $book_image;?>" alt="<?php echo $book_title;?>" class="book_image"> </td>
        <td><?php echo $book_price;?></td>
        <?php
        $get_count="select * from `orders_pending` where book_id=$book_id";
        $result_count=mysqli_query($con,$get_count);
        $row_count=mysqli_num_rows($result_count);

        ?>
        </td>
        <td><?php echo $status;?></td>
        <td> <a href="index.php?edit_book=<?php echo $book_id?>" class="text-light"> <i class="fa-solid fa-pen-to-square"></i> </a> </td>
        <td> <a href="index.php?delete_book=<?php echo $book_id?>" class="text-light"> <i class="fa-solid fa-trash"></i> </a> </td>
    </tr>
        <?php

        }
        ?>
    
    
    
    </tbody>
</table>
