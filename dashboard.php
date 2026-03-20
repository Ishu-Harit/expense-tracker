
<?php
session_start();
include("includes/db.php");

/* PROTECT PAGE */
if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* ADD TRANSACTION */
if(isset($_POST['add']))
{
    $category_id = $_POST['category_id'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $query = "INSERT INTO transactions 
    (user_id, category_id, amount, type, description, date)
    VALUES ('$user_id','$category_id','$amount','$type','$description','$date')";

    mysqli_query($conn,$query);

    header("Location: dashboard.php");
    exit();
}

/* DELETE */
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    mysqli_query($conn,"DELETE FROM transactions WHERE id=$id");

    header("Location: dashboard.php");
    exit();
}

/* TOTALS */
$income = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(amount) AS total FROM transactions WHERE type='income' AND user_id='$user_id'"))['total'] ?? 0;

$expense = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(amount) AS total FROM transactions WHERE type='expense' AND user_id='$user_id'"))['total'] ?? 0;

$balance = $income - $expense;

/* FETCH DATA */
$result = mysqli_query($conn,"
SELECT transactions.id,
       categories.name AS category,
       transactions.amount,
       transactions.type,
       transactions.description,
       transactions.date
FROM transactions
JOIN categories ON transactions.category_id = categories.id
WHERE transactions.user_id = '$user_id'
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.container{
    margin-top:30px;
}

.card{
    border:none;
    border-radius:12px;
    box-shadow:0px 5px 15px rgba(0,0,0,0.08);
}

.income{background:#d4edda;}
.expense{background:#f8d7da;}
.balance{background:#d1ecf1;}

</style>

</head>

<body>

<div class="container">

<h3>Welcome, <?php echo $_SESSION['name']; ?> 👋</h3>

<div class="row mt-4">

<div class="col-md-4">
<div class="card income p-3 text-center">
<h5>Income</h5>
<h4>₹ <?php echo $income; ?></h4>
</div>
</div>

<div class="col-md-4">
<div class="card expense p-3 text-center">
<h5>Expense</h5>
<h4>₹ <?php echo $expense; ?></h4>
</div>
</div>

<div class="col-md-4">
<div class="card balance p-3 text-center">
<h5>Balance</h5>
<h4>₹ <?php echo $balance; ?></h4>
</div>
</div>

</div>

<h4 class="mt-4">Add Transaction</h4>

<form method="POST">

<div class="row">

<div class="col-md-3">
<select name="category_id" class="form-control">
<option value="1">Food</option>
<option value="2">Rent</option>
<option value="3">Travel</option>
<option value="4">Shopping</option>
<option value="5">Health</option>
<option value="6">Others</option>
</select>
</div>

<div class="col-md-2">
<input type="number" name="amount" class="form-control" placeholder="Amount" required>
</div>

<div class="col-md-2">
<select name="type" class="form-control">
<option value="expense">Expense</option>
<option value="income">Income</option>
</select>
</div>

<div class="col-md-3">
<input type="text" name="description" class="form-control" placeholder="Description">
</div>

<div class="col-md-2">
<input type="date" name="date" class="form-control" required>
</div>

</div>

<br>

<button type="submit" name="add" class="btn btn-primary">Add</button>

</form>

<h4 class="mt-4">Transaction History</h4>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Category</th>
<th>Amount</th>
<th>Type</th>
<th>Description</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['category']; ?></td>
<td>₹ <?php echo $row['amount']; ?></td>
<td><?php echo $row['type']; ?></td>
<td><?php echo $row['description']; ?></td>
<td><?php echo $row['date']; ?></td>

<td>
<a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
</td>

</tr>

<?php } ?>

</table>

<a href="logout.php" class="btn btn-danger mt-3">Logout</a>

</div>

</body>
</html>

