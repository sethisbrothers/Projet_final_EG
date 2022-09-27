<h3 class="text-center text-success">Tous les Commandes</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-secondary">

 
        <?php
        //getting every data in user_order and display
        $get_orders="select * from `user_orders`";
        $result=mysqli_query($con,$get_orders);
        $row_count=mysqli_num_rows($result);
        
    // Display on the table all user_orders 
        if($row_count==0){
            echo "<h2 class='text-danger text-center mt-5'> Pas de commande disponible !</h2>";
        }else{
            echo"
            <tr class='text-center'>
                <th>N°</th>
                <th>Montant due</th>
                <th>Numero de commande</th>
                <th>Total des Livres</th>
                <th>Date de Commande</th>
                <th>Status</th>
                <th>Supprimer</th>
            </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
        ";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
            $order_id=$row_data['order_id'];
            $user_id=$row_data['user_id'];
            $amount_due=$row_data['amount_due'];
            $invoice_number=$row_data['invoice_number'];
            $total_books=$row_data['total_books'];
            $order_data=$row_data['order_date'];
            $order_status=$row_data['order_status'];
            $number++;

            echo "
                <tr class='text-center'>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$invoice_number</td>
                    <td>$total_books</td>
                    <td>$order_data</td>
                    <td>$order_status</td>
                    <td> <a href='index.php?delete_orders= $order_id' class='text-light'> <i class='fa-solid fa-trash'> </i> </a> </td>
                </tr>
            ";
            }
        }
        ?>
        
    </tbody>
</table>