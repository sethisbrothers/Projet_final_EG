<h3 class="text-center text-success">Tous les utilisateurs</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-secondary">

 
        <?php
        //getting every data in user_order and display
        $get_users="select * from `user_table`";
        $result=mysqli_query($con,$get_users);
        $row_count=mysqli_num_rows($result);
        
    // Display on the table all user_payments 
        if($row_count==0){
            echo "<h2 class='text-danger text-center mt-5'> Aucun utilisateur !</h2>";
        }else{
            echo"
            <tr class='text-center'>
                <th>N°</th>
                <th>Nom de l'Utilisateur</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Numéro de Téléphone</th>
                <th>Supprimer</th>
            </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
        ";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
            $user_id=$row_data['user_id'];
            $user_name=$row_data['user_name'];
            $user_email=$row_data['user_email'];
            $user_ip=$row_data['user_ip'];
            $user_address=$row_data['user_address'];
            $user_mobile=$row_data['user_mobile'];
            $number++;

            echo "
                <tr class='text-center'>
                    <td>$number</td>
                    <td>$user_name</td>
                    <td>$user_email</td>
                    <td>$user_address</td>
                    <td>$user_mobile</td>
                    <td> <a href='index.php?delete_users= $user_id' class='text-light'> <i class='fa-solid fa-trash'> </i> </a> </td>
                </tr>
            ";
            }
        }
        ?>
        
    </tbody>
</table>