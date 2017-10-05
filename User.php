<?php

include_once 'dbConfig.php';
class User
{
    private  $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function Register($name, $password, $email){

        try {
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $statement = $this->conn->prepare(
                '
                        INSERT INTO `users` (`id`, `name`, `password`, `email`) 
                        VALUES (NULL, :name, :password, :email)
');
            $statement->execute(array(
                "name" => $name,
                "password" => $passwordHashed,
                "email" => $email
            ));
        } catch (PDOException $e){
            echo $e->getMessage();

        }


    }
    public function Login($email, $password){


        try{
            $statement =  $this->conn->prepare(
                '
                        SELECT * FROM users WHERE email=:email
');
            $statement->execute(array(
                "email" => $email
            ));
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if ($statement->rowCount() == 1){
                if (password_verify($password, $row['password'])){
                    $_SESSION['user'] = $row['id'];
                    return true;
                } else{
                    return false;
                }
            }
        } catch (PDOException $e){

        }


    }
    public function redirect($url){
        header('Location: ' . $url);
    }
    public function logout()
    {
        session_destroy();
        unset($_SESSION['user']);
        return true;
    }
}
