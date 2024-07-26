<?php include ("../connection/conn.php"); 
session_start();

?>


<?php
if (isset($_POST['login'])){

    if(isset($_GET['id_new'])){
        $new_id = $_GET['id_new'];
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(empty($email)){
        header("location:login.php?error=Email is required");
    }
    else if(empty($password)){
        header("location:login.php?error=Password is required");
    }


    $query = "SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".$password."'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    if( $password == $row["password"] ){

        if($row["role"] == "admin"){
            $_SESSION['user_id'] = $row['id'];
            header('location:../admin/index.php?id=' . $row['id']); 
            exit();

        }
        
        
        else if($row["role"] == "user"){
            $_SESSION['user_id'] = $row['id'];
            header("location: ../home/index.php?id=" . $row['id']);
            exit();

        }

        else{
            header("location:login.php?error=Invalid Credentials"); 
        }

    }
        else{
            header("location:login.php?error=Incorrect Password");
            
        }

    } 
        
    

   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5 pt-5 d-flex justify-content-center align-items-center">

        <form method="post" style="width: 450px">
            <h1 class="p-3 text-center">LOGIN</h1>

            <?php if(isset($_GET['error'])) { ?>

            <div class="alert alert-danger" role="alert">
                <?=$_GET['error'] ?>
            </div>

            <?php } ?>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
</div>

  
</select>
<br>
<button type="submit" class="btn btn-primary me-2" name="login" >Login</button>
<a href="signup.php" class="btn btn-danger">Signup</a>
</form>
</div>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>