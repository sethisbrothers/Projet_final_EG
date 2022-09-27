<?php

// connect file

include('../includes/connect.php');
session_start();
if(isset($_GET['order_id'])){
     $order_id=$_GET['order_id'];

     //getting data to the database to display on payment 
     $select_data="select * from `user_orders` where order_id=$order_id";
     $result=mysqli_query($con,$select_data);
     $row_fetch=mysqli_fetch_assoc($result);
     $invoice_number=$row_fetch['invoice_number'];
     $amount_due=$row_fetch['amount_due'];
}
if(isset($_POST['Confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query="insert into `user_payments` (order_id,invoice_number,amount,payment_mode) values ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo"<script>alert('Commande Effectué avec Succes')</script>";
        echo"<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders="update `user_orders` set order_status='Commandé' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>

    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
</head>
<body class=bg-secondary>
    <div class="contianer my-5">
    <h1 class="text-center text-light">
        Confirmé votre paiement
    </h1>
        <form method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label class="text-light">Montant</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-control w-50 m-auto">
                    <option>Sectionner Votre Type de paiement</option>
                    <option>T-Money</option>
                    <option>Moov-Money</option>
                    <option>Payer au comptant</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" name="Confirm_payment" value="Confirmer">
            </div>
        </form>
    </div>
</body>
</html>
