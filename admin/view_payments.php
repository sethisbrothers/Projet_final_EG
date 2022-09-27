<h3 class="text-center text-success">Tous les Paiements</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-secondary">

 
        <?php
        //getting every data in user_order and display
        $get_payments="select * from `user_payments`";
        $result=mysqli_query($con,$get_payments);
        $row_count=mysqli_num_rows($result);
        
    // Display on the table all user_payments 
        if($row_count==0){
            echo "<h2 class='text-danger text-center mt-5'> Pas de Paiements disponible !</h2>";
        }else{
            echo"
            <tr class='text-center'>
                <th>N°</th>
                <th>Numero de commande</th>
                <th>Montant</th>
                <th>Mode de Paiement</th>
                <th>Date de Paiement</th>
                <th>Supprimer</th>
            </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
        ";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
            $payment_id=$row_data['payment_id'];
            $invoice_number=$row_data['invoice_number'];
            $amount_due=$row_data['amount'];
            $payment_mode=$row_data['payment_mode'];
            $payment_data=$row_data['date'];
            $number++;

            echo "
                <tr class='text-center'>
                    <td>$number</td>
                    <td>$invoice_number</td>
                    <td>$amount_due</td>
                    <td>$payment_mode</td>
                    <td>$payment_data</td>
                    <td> <a href='index.php?delete_payments= $payment_id' class='text-light'> <i class='fa-solid fa-trash'> </i> </a> </td>
                </tr>
            ";
            }
        }
        ?>
        
    </tbody>
</table>