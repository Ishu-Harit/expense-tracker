
<?php
session_start();
include("includes/db.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];

        header("Location: dashboard.php");
        exit();
    }
    else
    {
        echo "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#eef2f7,#d9e4f5);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-card{
    background:white;
    padding:40px;
    width:350px;
    border-radius:12px;
    box-shadow:0px 10px 25px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="login-card">

<h4 class="text-center mb-4">Login</h4>

<form method="POST">

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button type="submit" name="login" class="btn btn-primary w-100">Login</button>

</form>

</div>

</body>
</html>
