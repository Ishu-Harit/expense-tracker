</!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Expense Tracker</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<style>
		body{
			background: linear-gradient(135deg,#eef2f7,#d9e4f5);
    		margin:0;
    		height:100vh;
    		display:flex;
    		justify-content:center;
    		align-items:center;
   			font-family: Arial, Helvetica, sans-serif;
		}
		.main-box{
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.logo{
			width: 160px;
			margin-bottom: 8px;
		}
		h1{
			margin-bottom: 6px;
		}
		p{
			margin-bottom: 20px;
		}
		.btn:hover{
			transform: translateY(-2px);
			box-shadow: 0px 5px 15px rgba(0,0,0,0.15);
		}
		.btn{
			padding:10px 25px;
			font-size: 16px;
			border-radius: 8px;
			transition: 0.3s;
		}
	</style>
</head>
<body>
	<div class="container main-box">
		<div class="text-center">
			<img src="images/logo.png" class="logo">
			<h1>Expense Tracker</h1>
			<p>Track your income and expenses easily</p>
			<a href="login.php" class="btn btn-primary me-3">Login</a>
			<a href="register.php" class="btn btn-success">Register</a>
			
		</div>
	</div>

</body>
</html>>