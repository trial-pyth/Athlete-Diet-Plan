<?php
    
    //mysqli connection ro database athlete_diet_plan
    $conn=mysqli_connect('localhost','coach','admin','athlete_diet_plan');

    //check connection
    if(!$conn){
         echo 'Connection error: '. mysqli_connect_error();
    }
?>