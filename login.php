<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="login.php" method='post'>
<?php
class usersL{

private $username;
private $password;



function setUsername($name) {
    $this->username = $name;
  }
  function getUsername() {
    return $this->username;
  }

function setPassword($name) {
    $this->password = $name;
  }
  function getPassword() {
    return $this->password;
  }
}
if(isset($_POST["submit2"])){
    $user=new usersL();
    $user->setUsername($_POST["username"]);
  //  echo $user->getUsername();
  //  echo '<br>';
  $user->setPassword($_POST["psw"]);
//  echo $user->getPassword();
 $servername = "localhost";
$username = "user-data";
$password = "12345678";
 try{
  $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  echo "Connected successfully";
  echo '<br>';
 } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
 }
 $username1=$user->getUsername();
 $password1=$user->getPassword();


 $stmt = $conn->prepare("SELECT * FROM users_F WHERE username=? AND password=?");
 $stmt->execute([$username1,$password1]); 
 $userss = $stmt->fetch();
if($userss){
  echo 'hellloooo';
  header("Location: http://localhost/Ex2/home.php");
}else{
  echo 'username or password incorrect';
}

}
?>
  <div class="container">
    <h1>sign in</h1>


    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Email" name="username" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

  
    <button type="submit" name='submit2' class="registerbtn">Go</button>
  </div>


</form>

</body>
</html>