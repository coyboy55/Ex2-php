<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "user-data";
$password = "12345678";
try{
    $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
   
   } catch(PDOException $e) {
   
   }
   $stmt = $conn->query("SELECT * FROM blog");
while ($row = $stmt->fetch()) {
    echo $row['id'];
    echo '<br>';
    echo 'image src:----'.$row['blog-img-src']
   ."<br />\n" .'image overview: ---- '.$row['blog-overview']
    ."<br />\n".'image content: ---- '.$row['blog-content']
    ."<br />\n".'image title: ----'.$row['blog-title']
    ."<br />\n".'image date:  ----- '.$row['blog-date'];
    echo '<br>';
    echo '<br>';


}

     
     

?>
</body>
</html>