<?php
        include 'connectClass.php';
class UserC
{

    public function insertUser($username1, $email1, $password)
    {


        $db = ClassConnection::db_connect();

        
        $stmt = $db->prepare("SELECT * FROM users_F WHERE username=? or email=?");
        $stmt->execute([$username1, $email1]);
        $userss = $stmt->fetch();
        if ($userss) {
            echo 'allready used';

        } else {

            $stmt = $db->prepare("INSERT INTO users_F (username,email,password,name) VALUES (:username,:email,:password,:name)");

            $stmt->bindParam(':username', $username1);
            $stmt->bindParam(':email', $email1);

            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':name', $password);

            if ($stmt->execute()) {
  
                $row=$this->getUser($username1);
                $id=$row['id'];

                setcookie('username', $username1, time() + (86400 * 30), "/");
                setcookie('idU', $id, time() + (86400 * 30), "/");


                header("Location: http://localhost/Ex2/blogs.php");

            }
        }
    }


    public function getUser($id)
    {


        $conn = ClassConnection::db_connect();


    $stmt = $conn->query("SELECT * FROM users_F WHERE id=$id");
    $stmt->execute();
    $user = $stmt->fetch();
    return $user;
    }

    public function getUserpassword($username,$password)
    {


        $conn = ClassConnection::db_connect();


    $stmt = $conn->query("SELECT * FROM users_F WHERE id='$username' AND password='$password'");
    $stmt->execute();
    $user = $stmt->fetch();
    return $user;
    }

    public function editPassword($username,$newpassword)
    {


        $conn = ClassConnection::db_connect();

  $stmt = $conn->prepare("UPDATE users_F SET password=:newpassword WHERE id=:usernameOld");
  
            $stmt->bindParam(':usernameOld', $username);

            $stmt->bindParam(':newpassword', $newpassword);



            $stmt->execute();

            

            
        
    }

    public function editUsername($username,$id)
    {


        $conn = ClassConnection::db_connect();

  $stmt = $conn->prepare("UPDATE users_F SET username=:username WHERE id=:id");
  
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':id', $id);


$stmt->execute();
            
        
    }
    
}
?>