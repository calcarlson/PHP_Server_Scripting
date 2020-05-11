<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="jumbotron" style="background:DarkSeaGreen !important">
      <h1>Login</h1>
    </div>
    <div class="container">
      <div class="row">
              <p><br /></p>
      </div>
          <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                  <div class="panel panel-default">
                      <form name="addContact" method="post" action="#">
                          <p></p>
                          <table class="table table-bordered table-hover">
                              <tbody>
                                  <tr>
                                      <td class="col-md-6">Name</td>
                                      <td class="col-md-6">
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="name" required maxlength="30">
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="col-md-6">Password</td>
                                      <td class="col-md-6">
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="password" required maxlength="30">
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="col-md-6"></td>
                                      <td class="col-md-6">
                                          <input type="submit" name = "submit" value="Submit">
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </form>
                  </div>
              </div>
              <div class="col-md-4"></div>
          </div>
      </div>
  </body>  
<?php
if(isset($_POST['submit'])){
$selected_val = $_POST['name'];  // Storing Selected Value In Variable
$typed_val = $_POST['password'];  // Storing Selected Value In Variable

error_reporting(E_ALL);
ini_set( 'display_errors','1');
include_once 'database.php';
$con=new mysqli($db_servername, $db_username, $db_password, $db_name);
if (mysqli_connect_errno())
{
  echo 'Failed to connect to MySQL:' . mysqli_connect_error();
}
$sql = "SELECT * FROM tbl_accounts WHERE acc_login = '$selected_val' AND acc_password = '$typed_val'";
$result= $con->query($sql);
if ($result->num_rows > 0) {
  $_SESSION["value"] = 1;
  $_SESSION["name"] = $selected_val;\
echo '<script>window.location = "http://www-users.cselabs.umn.edu/~basal006/contacts.php" </script>';

} else {
    echo "<h2>Enter a Valid Username and Password</h2>";
  session_unset();
}\
}
?>
</html>
