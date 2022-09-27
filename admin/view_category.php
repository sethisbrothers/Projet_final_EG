<h3 class="text-center text-success">Tous les catégories</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>N°</th>
            <th>Titre des Catégories</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">

    <?php
    //Getting and display all category into category database
    $select_cat="select * from `category`";
    $result=mysqli_query($con,$select_cat);
    $number=0;
    while($row=mysqli_fetch_assoc($result)){
        $category_id=$row['category_id'];
        $category_title=$row['category_title'];
        $number++;
    ?>
        <tr class="text-center">
            <td><?php echo $number;?></td>
            <td><?php echo $category_title;?></td>
            <td> <a href="index.php?edit_category=<?php echo $category_id ?>" class="text-light"> <i class="fa-solid fa-pen-to-square"></i> </a> </td>
        <td> <a href="index.php?delete_category=<?php echo $category_id?>" type="button" class="text-light" data-toggle="modal" data-target="#exampleModal" > <i class="fa-solid fa-trash"></i> </a> </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>

<!-- part of the pop message with the bootstrap modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Vous êtes sûr de vouloir Supprimer ceci ?</h4> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-light text-decoration-none" data-dismiss="modal"> <a href="./index.php?view_category"></a> Non</button>
        <button type="button" class="btn btn-primary"> <a href="index.php?delete_category=<?php echo $category_id?>" class="text-light text-light text-decoration-none">Oui</a></button>
      </div>
    </div>
  </div>
</div>