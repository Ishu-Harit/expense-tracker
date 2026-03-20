<?php
include("includes/db.php");

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (name, email, password) 
              VALUES ('$name', '$email', '$password')";

    if(mysqli_query($conn, $query))
    {
        header("Location: login.php");
		exit();
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html>
<head>

<title>Register - Expense Tracker</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#eef2f7,#d9e4f5);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial, Helvetica, sans-serif;
}

.register-card{
    background:white;
    padding:40px;
    width:380px;
    border-radius:12px;
    box-shadow:0px 10px 25px rgba(0,0,0,0.1);
}

.logo{
    width:70px;
    display:block;
    margin:auto;
    margin-bottom:10px;
}

.title{
    text-align:center;
    font-weight:600;
    margin-bottom:25px;
}

.btn{
    border-radius:8px;
}

.login-link{
    text-align:center;
    margin-top:15px;
}

</style>

</head>

<body>

<div class="register-card">

<img src="images/logo.png" class="logo">

<h4 class="title">Create Account</h4>

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="register" class="btn btn-success w-100">Register</button>

</form>

<div class="login-link">
<p>Already have an account? <a href="login.php">Login</a></p>
</div>

</div>

</body>
</html>


