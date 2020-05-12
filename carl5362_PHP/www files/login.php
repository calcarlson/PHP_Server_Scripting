<?php
include_once 'database.php';
$_SESSION['value']=0;
$error = False;

if (isset($_POST['username'])) {
  $con=new mysqli($db_servername, $db_username, $db_password, $db_name);

  if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL:' . mysqli_connect_error();
  }

  $username = $_POST['username'];
  $password = base64_encode(hash("sha256",$_POST['password'],True));
  $result = mysqli_query($con, "SELECT acc_name, acc_password FROM tbl_accounts WHERE acc_login = '$username'");
  $con->close();

  if (mysqli_num_rows($result) < 1) {
    $error = True;
  }

  $row = mysqli_fetch_row($result);

  if ($row[1] != $password) {
    $error = True;
  }

  if (!$error) {
  	 $_SESSION['value']=1;
    $_SESSION['name'] = $row[0];
    
    header('Location: contacts.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <title>Login</title>
</head>

<body>
  <h1 style="align-content: center;">Login</h1>
  <div class="container">
    <form id="login" action="login.php" method="post">
      <div class="form-group">
        <label for="username">User:</label>
        <input class="form-control" type="text" name="username" id="username" required>
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input class="form-control" type="password" name="password" id="password" required>
      </div>

      <input class="btn btn-default" type="submit" value="Submit" id="submit">
    </form>
    <div id="error"><?php if ($error) echo "Error: Invalid credentials" ?></div>
  </div>

</body>

</html>