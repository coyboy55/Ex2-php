<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>
<header>
<header>
<?php include 'header.php'; ?>
</header>
</header>
<form method='post' action="Register.php">
<?php

require './ViewModel/userClass.php';

if (isset($_POST["submit1"])) {

    $username1 = $_POST["username"];
    $email1 = $_POST["email"];
    $password = $_POST["psw"];

    $userInsert = new UserC();
    $userInsert->insertUser($username1, $email1, $password);

}

?>

  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="email" required>

    <label for="email"><b>Email</b></label>
    <input  type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
 

    <button type="submit" name='submit1' class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>