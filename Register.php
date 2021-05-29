<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="style.css">
    <?php

$servername = "localhost";
$username = "user-data";
$password = "12345678";

try {
  $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



//$sql = "SELECT * FROM users_F";






?>
</head>
<body>

<form method='post' action="Register.php">
<?php
class users{

private $username;
private $email;
private $password;



function setUsername($name) {
    $this->username = $name;
  }
  function getUsername() {
    return $this->username;
  }


  function setEmail($name) {
    $this->email = $name;
  }
  function getEmail() {
    return $this->email;
  }

function setPassword($name) {
    $this->password = $name;
  }
  function getPassword() {
    return $this->password;
  }
}
if(isset($_POST["submit1"])){
    $user=new users();
    $user->setUsername($_POST["username"]);

   $user->setEmail($_POST["email"]);


  $user->setPassword($_POST["psw"]);

try{
 $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
 // set the PDO error mode to exception
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $e) {

}





  $username1=$user->getUsername();
  $email1=$user->getEmail();
  
  $stmt = $conn->prepare("SELECT * FROM users_F WHERE username=? or email=?");
 $stmt->execute([$username1,$email1]); 
 $userss = $stmt->fetch();
if($userss){
  echo 'allready used';

}else{

  $stmt = $conn->prepare("INSERT INTO users_F (username,email,password,name) VALUES (:username,:email,:password,:name)");

  $password=$user->getPassword();


  $stmt->bindParam(':username', $username1);
  $stmt->bindParam(':email',$email1) ;
  
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':name', $password);
  
  if($stmt->execute()){
    header("Location: http://localhost/Ex2/login.php");

  }
  }
  
}

?>




  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="email" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" name='submit1' class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>