<?php

include ('./ViewModel/classBlog.php');

if(isset($_POST['btn-save'])){
$title = $_POST["title"];
$overView = $_POST["overview"];
$content = $_POST["editor"];
$date = date("Y/m/d");
$userId=$_COOKIE['idU'];
$createBlog = new BlogClass();
$createBlog->createBlog($title, $overView, $content, $date,$userId);
}
?>