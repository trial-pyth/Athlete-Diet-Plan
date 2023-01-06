<?php

    include('config/db_connection.php');

    //query for all diet plan
    $sql= 'SELECT title, ingredients, id, name FROM diet ORDER BY created_at';

    //make query and get result
    $result=mysqli_query($conn,$sql);

    //fetch rows from query as array
    $diets=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    //free resut from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

    $images=array('cream-skin-svgrepo-com.svg','diet-juice-svgrepo-com.svg','diet-water-svgrepo-com.svg','dumbbell-gym-svgrepo-com.svg','football-soccer-svgrepo-com.svg','pizza.svg','tea-cup-coffee-svgrepo-com.svg')



    // print_r($diets);

    // print_r(explode(',',$diets[0]['ingredients']));

?>

<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Plan</title> -->

    <?php include('templates/header.php'); ?>

    <h4 class="center grey-text">Diets</h4>
    <div class="container">
        <div class="row flex">

            <?php foreach($diets as $diet) :?>
                
                <div class="col s6 m3 ">
                    <div class="card z-depth-0">
                        <img src="./img/<?php echo $images[floor(rand(0,count($images)-1))]?>" class="food">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($diet['title']); ?></h6>
                            <ul>
                                <?php foreach(explode(',',$diet['ingredients']) as $food) :?>
                                    <li> <?php echo htmlspecialchars($food) ?> </li>    
                                <?php endforeach; ?>    
                            </ul>
                        </div>
                        <div class="card-action">
                            <strong class="card-action left-align">By: <?php echo $diet['name'] ?></strong>
                            <a href="details.php?id=<?php echo $diet['id'] ?>" class="brand-text right-align">more info...</a>
                        </div>
                        
                    </div>
                    <!-- <br /> -->
                </div>

            <?php endforeach; ?>  
              
        </div>
    </div>

    <?php include('templates/footer.php'); ?>
</head>
<body>
    
</body>
</html>








