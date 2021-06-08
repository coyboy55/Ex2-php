<?php
include './ViewModel/classFiles.php'; 
?>

<link rel="stylesheet" href="style.css">
<header>
<?php include 'header.php'; 

?>
</header>
<?php

if (!isset($_COOKIE['idU'])) {
    header("Location: http://localhost/Ex2/login.php");

}
if(isset($_POST['saveF'])){
 $instance=new FileClass();
 $id=$_COOKIE['idF'];
 $name=$_POST['urnamFile'];
 $instance->editFileName($name,$id);
}
?>
<?php

if(isset($_POST['deleteFile'])){
  $instance=new FileClass();
  $id=$_GET['id'];

  $instance->deleteFile($id);

}


$servername = "localhost";
$username = "user-data";
$password = "12345678";
try {
    $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

}
$stmt = $conn->query("SELECT * FROM files");
?>
<div class='connn'>
<?php
while ($row = $stmt->fetch()) {
    $url = 'http://localhost/Ex2/upload/' . $row['path'];
    ?>
  <div class='fileContainer'>
  <tr >

    <td ><span>Path:</span>  <a href='<?php echo $url;?>'> <?php echo $row['name'];?>  </a></td>
    <td> <span>Format:</span> <?php echo $row['format'];?> </td>
    <td> <span>Size:</span>  <?php echo $row['size'];?>KB </td>
    <td> <p> <form action='files.php?id=<?php echo $row['id']; ?>' method='post'><button name='deleteFile' type='submit'>X</button></form></p>
    <td> <p> <a href='http://localhost/Ex2/upload/<?php echo $row['path']; ?>' download> download </a></p>

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