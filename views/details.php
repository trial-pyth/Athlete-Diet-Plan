<?php

    include('config/db_connection.php');
    
    if (isset($_POST['delete'])){

        $id_delete=mysqli_real_escape_string($conn,$_POST['id_delete']);

        $sql="DELETE FROM diet WHERE id=$id_delete";

        if(mysqli_query($conn,$sql)){
            //success
            header('Location:index.php');
        } else {
            //failure

            echo 'query failed ' . mysqli_error($conn);
        }
    }
        
    //check GET id parameter
    if(isset($_GET['id'])){
        $id=mysqli_real_escape_string($conn,$_GET['id']);

        //make sql query string
        $sql="SELECT * FROM diet WHERE id = $id";

        //get result from query
        $result=mysqli_query($conn,$sql);

        //fetch result in array format
        $diet=mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);

        // print_r($diet);
    }


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container center">
    <?php if($diet): ?>

        <h4><?php echo htmlspecialchars($diet['title']); ?></h4>
        <p>Created by: <strong><?php echo htmlspecialchars($diet['name']) ?></strong></p>
        <p>Email: <strong><?php echo htmlspecialchars($diet['email']) ?></strong></p>
        <p>Last Updated: <strong><?php echo date($diet['created_at']); ?></strong></p>
        <h6>Ingredients: </h6>
        <p><?php echo htmlspecialchars($diet['ingredients']); ?></p>
        

        <!-- delete form -->

        <form action="details.php" method="POST">
            <input type="hidden" name="id_delete" value="<?php echo $diet['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>

    <?php else: ?>
        <h5>No such diet exists</h5>
    <?php endif; ?>


</div>

<?php include('templates/footer.php'); ?>

</html>