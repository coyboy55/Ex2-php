<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

</body>
<header>

<header>
<?php include 'header.php'; ?>
</header>

</header>
<?php

if (!isset($_COOKIE['idU'])) {
    header("Location: http://localhost/Ex2/login.php");

}

?>
<?php
include ('./ViewModel/classBlog.php');

$instance=new BlogClass();
$getBlog=$instance->getBlogs();


if(isset($_POST['delete'])){
  $id=$_GET['id'];
$instance->deleteBlog($id);
}


?>
<div class="card connn">

  
  <?php
while ($row = $getBlog->fetch()) {
    ?>

<div class="container">

  <h3> <?php echo $row['blogTitle'];?></h3>
    <h6><b><?php echo $row['blogOoverview'];?></b></h6>
    <h6><b><?php echo $row['blogContent'];?></b></h6>


    </div>
    <?php
}

?>

</div> 




</html>