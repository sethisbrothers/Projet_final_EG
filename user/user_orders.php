 <!-- This file are calling into profile.php  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders page</title>
</head>
<body>
<?php
// this part work if the user is connect and getting the id of the user
    $user_name=$_SESSION['username'];
    $get_user="select * from `user_table` where user_name='$user_name'";
    $result=mysqli_query($con,$get_user);
    $row_fetch=mysqli_fetch_assoc($result);
    $user_id=$row_fetch['user_id'];

?>
    <h3 class="text-success">Tous Mes Commandes</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>n°</th>
                <th>Montant due</th>
                <th>Livre Total</th>
                <th>Numéro de commande</th>
                <th>Date</th>
                <th>Commandé/Non Commandé</th>
                <th>Status</th>
            </tr>
        </thead>
    <?php

    //getting the data on the database and to diplay in the table
    $get_order_details="select * from `user_orders` where user_id=$user_id";
    $result_orders=mysqli_query($con,$get_order_details);
    $number=1;
    while($row_orders=mysqli_fetch_assoc($result_orders)){
        $order_id=$row_orders['order_id'];
        $amount_due=$row_orders['amount_due'];
        $total_book=$row_orders['total_books'];
        $invoice_number=$row_orders['invoice_number'];
        $order_status=$row_orders['order_status'];
        if($order_status=='pending'){
            $order_status='Non Commandé';
        }else{
            $order_status='Commandé';
        }
        $order_date=$row_orders['order_date'];
        echo "
        <tbody class='bg-secondary text-light'>
            <tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$total_book</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td>";
                ?>
                <?php
                if($order_status=='Commandé'){
                    echo "<td>Payé</td>";
                }else{
                    echo "<td> <a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confrim</a> </td>
                    </tr>";
                }
                $number++;
    }
                ?>
              
        </tbody> 
</table>
</body>
</html>
