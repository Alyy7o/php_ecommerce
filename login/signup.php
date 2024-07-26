<?php include ("../connection/conn.php"); ?>

<?php

if(isset($_POST['signup'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = "INSERT INTO `users`(`role`, `name`, `email`, `password`, `phone`, `address`) VALUES ('$role','$name','$email', '$password', '$phone', '$address' )";
    $result = mysqli_query($connection, $query);

    if(!$result){
        echo "Query Failed!";
    }
    else{
        header("location:login.php?admin_add=Admin Added");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5 pt-5 d-flex justify-content-center align-items-center">

        <form method="post">
        <h1 class="p-3 text-center">REGISTER</h1>

            <div class="form-group">
                <!-- <label>Username</label> -->
                <input type="text" class="form-control" name="name" placeholder="Username">
            </div>

            <div class="form-group my-3">
                <!-- <label>Phone</label> -->
                <input type="text" class="form-control" name="phone" placeholder="Phone">
            </div>
    
            <div class="form-group">
                <!-- <label>Address</label> -->
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>

            <div class="form-group my-3">
                <!-- <label for="exampleInputEmail1">Email address</label> -->
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
                <!-- <label for="exampleInputPassword1">Password</label> -->
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>


            <div class="form-group mt-3">
                <label for="exampleInputType1" class="mt-2 mb-1 ">Select User Type:</label>
                <select name="role" class="form-select" aria-label="Default select example">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
            </div>


<br>
<input class="btn btn-success mt-3" type="submit" name="signup" value="Signup">
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>