<?php
include ('./ViewModel/userClass.php');
include ('./ViewModel/classBlog.php');
include ('./ViewModel/classFiles.php');



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">


</head>
<body>
<?php
if(isset($_POST["submit3"])){

    unset($_COOKIE['username']);
    setcookie('username', '', time() - 3600, '/');
    header('Location: http://localhost/Ex2/login.php ');
}

if (isset($_POST['submit5'])) {

  $instance = new UserC();
  $usernameOld=$_COOKIE['idU'];
  $password = $_POST["uroldpass"];
  $row=$instance->getUserpassword( $usernameOld, $password);
  if($row){ 
  $username = $_POST["urname"];
  $instance->editUsername($username,$usernameOld);
  setcookie('idU', $usernameOld, time() + (86400 * 30), "/");
  }else{
    echo 'ur old password invalid';
  }
}

if (isset($_POST['savePass'])) {
    $instance = new UserC();
    $usernameOld=$_COOKIE['idU'];
    $password = $_POST["urpassold"];
    $row=$instance->getUserpassword( $usernameOld, $password);
    if($row){ 
    $newpass = $_POST["urpassnew"];
    $instance->editPassword($usernameOld, $newpass);
    }else{
      echo 'ur old password invalid';
    }
  }

?>
<header>

<div class="header">
  <a href="#default" class="logo">CompanyLogo</a>
  <div class="header-right">
    <a class="active" href="http://localhost/Ex2/blogs.php">blogs</a>
    <a href="#contact">Contact</a>
    <a href="http://localhost/Ex2/myAccount.php">my account</a>
    <a href="http://localhost/Ex2/View/uploadblog.html">add blog</a>
    <a href="http://localhost/Ex2/View/uploadFiles.html">add file</a>


  </div>
</div> 

</header>
<form method='post'>
<button type='submit' name='submit3'>logout</button>
<button type='submit' name='submit4'>edit my user account</button>
<button type='submit' name='editPass'>edit my password account</button>
<button type='submit' name='myblog'>my blogs</button>
<button type='submit' name='myfiles'>my files</button>
</form>
<?php



if(isset($_POST["submit4"])){
 $id=$_COOKIE['idU'];

 $instance = new UserC();
 $row = $instance->getUser($id);
  ?>
  <form method='post'>
   <input type="text" value='<?php echo $row['username']; ?> ' placeholder="edit ur name" name="urname" id="email" required>
    <input type="text" placeholder="Enter password" name="uroldpass" id="email" required>

    
    <input type='submit' name='submit5' value='save'/>
    </form>
    <?php }else if(isset($_POST["editPass"])){
       ?>


       <form method='post'>
        <input type="text"  placeholder="edit ur old password" name="urpassold" id="email" required>
        <input type="text" placeholder="Enter ur new password" name="urpassnew" id="email" required>
         <input type='submit' name='savePass' value='save'/>
         </form>
         <?php


    }else if(isset($_POST["myblog"])){
      
$instance=new BlogClass();
$idU=$_COOKIE['idU'];
$getBlog=$instance->getBlogUser($idU);
?>
<div class="card">

  
  <?php
while ($row = $getBlog->fetch()) {
      ?>

<div class="container">

  <h3> <?php echo $row['blogTitle'];?></h3>
    <h6><b><?php echo $row['blogOoverview'];?></b></h6>
    <h6><b><?php echo $row['blogContent'];?></b></h6>

    <p> <form action='blogs.php?id=<?php echo $row['id']; ?>' method='post'><button name='delete' type='submit'>X</button></form></p>
    
    
    <p> <form action='View/editblog.php?id=<?php echo $row['id']; ?>' method='post'><button name='edit' type='submit'>EDIT</button></form></p>
    </div>


      <?php } 
    ?>
</div> 
<?php } else if(isset($_POST["myfiles"])){

$instance=new FileClass();
$idU=$_COOKIE['idU'];
$getFiles=$instance->getFileUser($idU);

    ?>
    <div class='connn'>
<?php
while ($row = $getFiles->fetch()) {
    $url = 'http://localhost/Ex2/upload/' . $row['path'];
    ?>
  <div class='fileContainer'>
  <tr >

    <td ><span>Path:</span>  <a href='<?php echo $url;?>'> <?php echo $row['name'];?>  </a></td>
    <td> <span>Format:</span> <?php echo $row['format'];?> </td>
    <td> <span>Size:</span>  <?php echo $row['size'];?>KB </td>
    <td> <p> <form action='files.php?id=<?php echo $row['id']; ?>' method='post'><button name='deleteFile' type='submit'>X</button></form></p>
</td>
<td>
    
<p> <form action='files.php?id=<?php echo $row['id']; ?>' method='post'><button name='editFile' type='submit'>EDIT</button></form></p>
<?php 
if(isset($_POST['editFile'])){
  $id = $_GET['id'];

    setcookie('idF', $id, time() + (86400 * 30), "/");
  ?>
 <form method='post'>
        <input type="text"  placeholder="ur new name" name="urnamFile" id="email" required>
         <input type='submit' name='saveF' value='save'/>
         </form>
<?php } ?>

  </td>
  </tr>
</div>
<?php
}

?>
</div>
<?php
}

?>
</form>
</body>
</html>

