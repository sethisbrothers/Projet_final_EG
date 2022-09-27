
    <h3 class="text-danger mb-4">Supprimer le Compte</h3>
    <form method="post" class="mt-5">
        <div class="form-outline mb-5">
            <input type="submit" value="Supprimer Son Compte" class="form-control w-50 m-auto" name="delete">
        </div>
        <div class="form-outline">
            <input type="submit" value="Garder Mon Compte" class="form-control w-50 m-auto" name="dont_delete">
        </div>
    </form>
<?php
    $username_section=$_SESSION['username'];
    if(isset($_POST['delete'])){
        $delete_query="delete from `user_table` where user_name='$username_section'";
        $result=mysqli_query($con,$delete_query);
        if($result){
            session_destroy();
            echo "<script>alert('Compte Supprimé')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
        }
    }
    if(isset($_POST['dont_delete'])){
        echo "<script>window.open('profile.php,'_self')</script>";
    }
?>