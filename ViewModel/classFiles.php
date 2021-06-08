<?php

include 'connec.php';
class FileClass
{

    public function createFile($name, $size, $format,$path,$userId)
    {


        $conn = Connec::db_connect();


            $stmt = $conn->prepare("INSERT INTO files (name,size,format,path,userId) 
            VALUES (:name,:size,:format,:path,:userId)");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':size', $size);

            $stmt->bindParam(':format', $format);
            $stmt->bindParam(':path', $path);
            $stmt->bindParam(':userId', $userId);


            if ($stmt->execute()) {

                header("Location: http://localhost/Ex2/files.php");

            }
        
    }
    public function getFiles()
    {


        $conn = Connec::db_connect();


    $stmt = $conn->query("SELECT * FROM blog");
    return $stmt;
    }

    public function getFileUser($id)
    {


        $conn = Connec::db_connect();


    $stmt = $conn->query("SELECT * FROM files WHERE userId=$id");
    return $stmt;
    }

    public function getFile($id)
    {


        $conn = Connec::db_connect();


    $stmt = $conn->query("SELECT * FROM blog WHERE id=$id");
    $stmt->execute();
    $blog = $stmt->fetch();
    return $blog;
    }

    public function deleteFile($id)
    {

        $conn = Connec::db_connect();


            $stmt = $conn->prepare("DELETE FROM files WHERE id=?");

            $stmt->execute([$id]);

                if ($stmt->execute()) {

                header("Location: http://localhost/Ex2/files.php");

            }
        
    }
    public function editFileName($name,$id)
    {


        $conn = Connec::db_connect();
//  $stmt = $conn->prepare("UPDATE blog SET blogTitle='aaaaaaaaaa', blogOoverview='aaaaaa',blogContent='aaaaaaa' WHERE id=49");
  $stmt = $conn->prepare("UPDATE files SET name=:name WHERE id=:id");
  
            $stmt->bindParam(':name', $name);
          
            $stmt->bindParam(':id', $id);


            if ($stmt->execute()) {

                header("Location: http://localhost/Ex2/files.php");

            }
        
    }

}
?>