<?php

    include('config/db_connection.php');

    $title=$email=$name=$ingredients='';
    $errors=array('email'=>'','name'=>'','title'=>'','ingredients'=>'');

    if (isset($_POST['submit'])){
        // 
        // echo htmlspecialchars($_POST['title']);
        // echo htmlspecialchars($_POST['ingredients']);

        //check email
        if(empty($_POST['email'])){
            $errors['email']= 'An email is required <br/>';
        }else {
            $email=$_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email']= 'Email must be a valid email address <br/>';
            }
        }
        if(empty($_POST['name'])){
            $errors['name']= 'A name is required <br/>';
        }else {
            $name=$_POST['name'];
            if (!preg_match('/^[a-zA-Z\s]+$/',$name)){
                $errors['name']= 'Name must be a valid name <br/>';
            }
        }
        if (empty($_POST['title'])){
            $errors['title']= 'A title is required <br/>';
        }else {
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z\s]+$/',$title)){
                $errors['title']= 'Title must be letters and spaces only';
            }
        }
        if(empty($_POST['ingredients'])){
            $errors['ingredients']= 'At least one ingredient is required <br/>';
        }else {
            $ingredients=$_POST['ingredients'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients']= 'Ingredients must be seperated by commas';
            }
        }

        if(array_filter($errors)){
            // echo 'error in the form';
        } else {
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            $name=mysqli_real_escape_string($conn,$_POST['name']);
            $ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);

            //create sql insertion
            $sql="INSERT INTO diet(title,email,name,ingredients) VALUES ('$title','$email','$name','$ingredients')";

            //save to db and verify
            if(mysqli_query($conn,$sql)){
                //success and redirect back
                header('Location: index.php');

            } else {
                //error 
                echo 'query error: ' . mysqli_error($conn);
            }

        }
    }
?>

<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Plan</title> -->

    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add a recipe</h4>
        <form action="add.php" method="POST" class="white">
            <label for="email">Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']  ?></div>
            <label for="name">Your Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
            <div class="red-text"><?php echo $errors['name']  ?></div>
            <label for="title">Diet title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $errors['title']  ?></div>
            <label for="ingredients">Food and Ingeredients:</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text"><?php echo $errors['ingredients']  ?></div>
            <div class="center">
                <input type="submit" name="submit" value="add" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>
</head>
<body>
    
</body>
</html>