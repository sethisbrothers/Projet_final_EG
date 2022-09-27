<?php
include('../includes/connect.php');
include('../functions/common_function.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>

    <style>
        img{
            width:50%;
            margin:auto;
            display:block;
        }
    </style>

    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <!-- style css link -->
    <link rel="stylesheet" href="style.css">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<!-- php code to access user id -->
<?php
 $user_ip=getIPAddress();
 $get_user="select * from `user_table` where user_ip='$user_ip'";
 $result=mysqli_query($con,$get_user);
 $run_query=mysqli_fetch_array($result);
 $user_id=$run_query['user_id'];
?>


    <div class="container">
        <h2 class="text-center text-info">Options de Paiement</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
                <a href="https://www.moov-africa.tg" target="_blank"> <img src="../images/moov.png" alt="Logo de paiement de moov"></a>
                <a href="https://www.togocom.tg" target="_blank"> <img src="../images/tmoney.png" alt="Logo de paiement de togocom"></a>
            </div>
            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>" target="_blank"> <h2 class="text-center">Paiement hors ligne</h2></a>
            </div>
        </div>
    </div>



    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>