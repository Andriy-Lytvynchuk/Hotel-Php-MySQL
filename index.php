<?php
require_once "database/connect.php";
session_start();

 if($_SERVER['REQUEST_METHOD'] == 'GET') {
     session_unset();
 }


try {
    $dbcon;
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['submit'])) {

        if(empty($_POST['username']) || empty($_POST['password'])) {
            $message = '<label>Please fill both fields</label>';
        } else {
            $query = "SELECT * FROM users WHERE username = :username";
            $statement = $dbcon->prepare($query);
            $statement->execute(
                array('username'  =>  $_POST['username']));

            $count = $statement->rowCount();


            if($count > 0) {
                $row = $statement->fetch();
                $hashed_password = $row['password'];

                if (password_verify($_POST['password'], $hashed_password)) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                    $privilege = $row['privilege'];

                    header("location:pages/about/about-admin.php");

                }else {
                    $error = '<label>Incorrect login details</label>';
                }
            }

        }
    }
}
catch(PDOException $error)
{
    $message = $error->getMessage();
}
/*if (isset($dbcon)) {
    echo 'Connected';
} elseif (isset($error)) {
    echo $error;
} else {
    echo 'Unknown error';
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        body { font-size: 16px; line-height: 1.3em;}
        .container {max-width: 500px; margin: 12px auto; text-align: center;}
        h1  {color:#09529c; font-size: 1.5em;}
        #btn-links {margin: 10px;}
        /*#links a:nth-child(1){margin-right: 20px;}*/
        /*{display: inline-block; margin-top: 10px;}*/
        .btn {margin-bottom: 12px;}
        form {width:300px; margin:20px auto; border: 1px lightgrey solid;
            padding:10px; border-radius: 5px}
        input[type="submit"]{margin-top: 15px; margin-bottom: 0px;}
        .form-group  {width:260px; margin-left: auto; margin-right: auto;}
        .form-group label {margin-left: -180px;}
        form h2 {font-size: 1.2em; margin-bottom: 15px;}
        .btn {padding: 0.25rem 0.6rem;}
    </style>
</head>

<body>
<div class="container" style="width:500px;">

    <h1> Welcome! </h1>
    <p>Please choose login option below to see
        Guest or Admin interface</p>
      <p>Please contact me on <a href="https://www.linkedin.com/in/andriy-lytvynchuk/">Linked in</a> to get login credentials for Admin account.
      Alternatively you may view the code on my <a href="https://github.com/Andriy-Lytvynchuk">Git Hub page</a>
      </p>
<!--    <div id="btn-links">-->
        <a href="pages/about/about.php" class="btn btn-primary">Guest Login</a>
<!--    </div>-->
  <br>

<!--  LOGIN FORM  ---------->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h2>Admin login form</h2>
      <div class="form-group ">
          <label>Username</label>
          <input type="password" name="username" class="form-control" value="<?php if(isset($_POST["submit"])) {echo $_POST["username"];} ?>">
      </div>

      <div class="form-group">
          <label >Password</label>
          <input type="password" name="password" class="form-control" value="<?php if(isset($_POST["submit"])) {echo $_POST["password"];} ?>">
      </div>

      <?php
      if(isset($message))
      {
          echo '<label class="text-danger">'.$message.'</label>';
      }
      ?>

      <div class="form-group">
          <input type="submit" name="submit" class="btn btn-warning" value="Admin Login">
      </div>
<!--      <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->
  </form>

<!--  <a href="pages/about/about-admin.php" class="btn btn-warning">Admin</a> <br>-->

  <a href="https://webelf.ca">Back to Portfolio</a>

</div>
</body>
</html>