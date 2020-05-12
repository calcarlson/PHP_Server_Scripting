<?php
  session_start();
  //check if login has been successful
  if($_SESSION["value"] != 1){
   echo '<script>window.location = "http://www-users.cselabs.umn.edu/~carl5362/login.php" </script>';
  }
include_once 'database.php';
$con=new mysqli($db_servername, $db_username, $db_password, $db_name);

if (mysqli_connect_errno()) {
  echo 'Failed to connect to MySQL:' . mysqli_connect_error();
}

if (!empty($_POST['contact_id'])) {
  $id = $_POST['contact_id'];
  $squery = "SELECT * FROM tbl_contacts WHERE contact_id=$id";
} else if (!empty($_POST['contact_name'])) {
  $name = $_POST['contact_name'];
  $squery = "SELECT * FROM tbl_contacts WHERE contact_name LIKE '%$name%'";
} else if (!empty($_POST['contact_email'])) {
  $email = $_POST['contact_email'];
  $squery = "SELECT * FROM tbl_contacts WHERE contact_email LIKE '%$email%'";
}  else if (!empty($_POST['contact_address'])) {
  $address = $_POST['contact_address'];
  $squery = "SELECT * FROM tbl_contacts WHERE contact_address LIKE '%$address%'";
} else if (!empty($_POST['contact_phone'])) {
  $phone = $_POST['contact_phone'];
  $squery = "SELECT * FROM tbl_contacts WHERE contact_phone LIKE '%$phone%'";
}
else if (!empty($_POST['contact_favoriteplace'])) {
  $place = $_POST['contact_favoriteplace'];
  $squery = "SELECT * FROM tbl_contacts WHERE contact_favoriteplace LIKE '%$place%'";
}
else {
  $squery = "SELECT * FROM tbl_contacts";
}

$result = mysqli_query($con, $squery);
if (!$result) print(mysqli_error($con));
$con->close();

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Contacts</title>
</head>

<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li>
          <a href="contacts.php">
            <b>Contacts</b>
          </a>
        </li>
        <li>
          <a href="login.php">
            <span class="glyphicon glyphicon-log-out"></span>
          </a>
        </li>
      </ul>
      <p id="user">User: <?php print($_SESSION['name']) ?></p>
    </div>
  </nav>
  <div class="container">
    <h2>Contacts</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Address</th>
          <th scope="col">Phone</th>
          <th scope="col">Favorite Place</th>
          <th scope="col">URL</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($row = mysqli_fetch_row($result)) {
            print("<tr>");
            print("<td>$row[0]</td>");
            print("<td>$row[1]</td>");
            print("<td>$row[2]</td>"); 
            print("<td>$row[3]</td>");
            print("<td>$row[4]</td>");
            print("<td>$row[5]</td>");
            print("<td>$row[6]</td>");
            print("</tr>");
          }
        ?>
      </tbody>
    </table>

    <h2>Filter Criteria</h2>
 
    <form id="filter" action="contacts.php" method="post">
      <div class="form-group">
        <label for="contact_name">Name:</label>
        <input class="form-control" type="text" name="contact_name" id="contact_name" placeholder="Enter Name">
        <label for="contact_email">Email:</label>
        <input class="form-control" type="text" name="contact_email" id="contact_email" placeholder="Enter Email">
        <label for="contact_address">Address:</label>
        <input class="form-control" type="text" name="contact_address" id="contact_address" placeholder="Enter Address">
        <label for="contact_phone">Phone:</label>
        <input class="form-control" type="text" name="contact_phone" id="contact_phone" placeholder="Enter Phone Number">
        <label for="contact_favoriteplace">Favorite Place:</label>
        <input class="form-control" type="text" name="contact_favoriteplace" id="contact_favoriteplace" placeholder="Enter Favorite Place">
      </div>
      
      <input class="btn btn-primary btn-block" type="submit" value="Filter" id="submit">
    </form>
  </div>
</body>
</html>