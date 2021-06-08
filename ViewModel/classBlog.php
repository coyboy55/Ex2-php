<?php

include 'connect1.php';
class BlogClass
{

    public function createBlog($title, $overView, $content,$date,$userId)
    {


        $conn = Connection::dbConnect();


            $stmt = $conn->prepare("INSERT INTO blog (blogTitle,blogOoverview,blogContent,blogDate,userId) 
            VALUES (:title,:overView,:content,:date,:userId)");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':overView', $overView);

            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':userId', $userId);


            if ($stmt->execute()) {

                header("Location: http://localhost/Ex2/blogs.php");

            }
        
    }
    public function getBlogs()
    {
        $conn = Connection::dbConnect();


    $stmt = $conn->query("SELECT * FROM blog");
    return $stmt;
    }

    public function getBlogUser($id)
    {


        $conn = Connection::dbConnect();

    $stmt = $conn->query("SELECT * FROM blog WHERE blog.userId=$id");
    return $stmt;
    }

    public function getBlog($id)
    {


        $conn = Connection::dbConnect();


    $stmt = $conn->query("SELECT * FROM blog WHERE id=$id");
    $stmt->execute();
    $blog = $stmt->fetch();
    return $blog;
    }

    public function deleteBlog($id)
    {

        $conn = Connection::dbConnect();


            $stmt = $conn->prepare("DELETE FROM blog WHERE id=?");

            $stmt->execute([$id]);

                if ($stmt->execute()) {

                header("Location: http://localhost/Ex2/blogs.php");

            }
        
    }
    public function editBlog($title, $overview, $content,$date,$id)
    {


        $conn = Connection::dbConnect();
//  $stmt = $conn->prepare("UPDATE blog SET blogTitle='aaaaaaaaaa', blogOoverview='aaaaaa',blogContent='aaaaaaa' WHERE id=49");
  $stmt = $conn->prepare("UPDATE blog SET blogTitle=:title, blogOoverview=:overview, blogContent=:content, blogdate=:date WHERE id=:id");
  
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':overview', $overview);

            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':id', $id);


            if ($stmt->execute()) {

                header("Location: http://localhost/Ex2/blogs.php");

            }
        
    }

    public function edit()
    {


        $conn = Connection::dbConnect();

        $stmt = $conn->prepare("UPDATE blog SET blogTitle='aaaaaaaaaa',  blogOoverview='aaaaaa',   blogContent='aaaaaaa' WHERE id=49");
  $stmt->execute();
            // $stmt->bindParam(':title', $title);
            // $stmt->bindParam(':overview', $overview);

            // $stmt->bindParam(':content', $content);
            // $stmt->bindParam(':date', $date);
            // $stmt->bindParam(':id', $id);


            // if ($stmt->execute()) {

            //     header("Location: http://localhost/Ex2/blogs.php");

            // }
        
    }


}
?>