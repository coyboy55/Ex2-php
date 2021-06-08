<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>

    <link rel="stylesheet" href="./Blogs.css">

    <title>New Blog</title>

</head>
<?php
include '../ViewModel/classBlog.php';
$instance = new BlogClass();
$id = $_COOKIE['id'];
$row = $instance->getblog($id);

if (isset($_POST['edit'])) {
    $id = $_GET['id'];

    setcookie('id', $id, time() + (86400 * 30), "/");

}

if (isset($_POST['edited'])) {
    $title = $_POST["title"];
    $overview = $_POST["overview"];
    $editor = $_POST["editor"];
    $date = date("Y/m/d");
    $id = $_COOKIE['id'];

    $instance->editBlog($title, $overview, $editor, $date, $id);
}

?>
<body>

    <form action='editblog.php' method="post">

        <div class="container containerrad">
            <div class="allin">
                <h1 class="titleBlog">EDIT BLOG</h1>

                <input type="text" value='<?php echo $row['blogTitle']; ?> ' name="title" id="title" required />

                <input type='textarea' value='<?php echo $row['blogOoverview']; ?>' name="overview" id="overview" />

                <div class="divofTextarea">
                    <textarea value='hello' name="editor" id="editor"> <?php echo $row['blogContent']; ?>  </textarea>
                </div>
                <button type="submit" name="edited" class="savebtn">
                    Save
                </button>
            </div>
        </div>
    </form>

    <script>
    CKEDITOR.replace('editor');
    </script>
    <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</body>

</html>
