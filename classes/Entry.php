<?php

include_once 'dbConfig.php';
class Entry
{
    private  $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insert($title, $entry_text, $ownerId){

        try {
            $statement = $this->conn->prepare(
                '
                        INSERT INTO `entries` (`id`, `title`, `entry_text`, `ownerId`) 
                        VALUES (NULL, :title, :entry_text, :ownerId)
');
            $statement->execute(array(
                "title" => $title ,
                "entry_text" => $entry_text,
                "ownerId" => $ownerId
            ));
            return true;
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }
    public function delete($id){
        $statement =  $this->conn->prepare(
            '
                        DELETE FROM entries WHERE id=:id
');
        $statement->execute(array(
            "id" => $id
        ));
        return true;

    }

    public function getEntries($ownerId){
        $statement =  $this->conn->prepare(
            '
                        SELECT * FROM entries WHERE ownerId=:ownerId
');
        $statement->execute(array(
            "ownerId" => $ownerId
        ));
        return $statement->fetchAll();


    }
    public function getEntry($id){
        $statement =  $this->conn->prepare(
            '
                        SELECT * FROM entries WHERE id=:id
');
        $statement->execute(array(
            "id" => $id
        ));
        return $statement->fetchAll();


    }

    public function update($id, $title, $entry_text){

        try {
            $statement = $this->conn->prepare("
UPDATE entries SET title=:title, 
entry_text=:entry_text
WHERE id=:id ");
            $statement->execute(array(
                "title" => $title ,
                "entry_text" => $entry_text,
                "id" => $id
            ));
            return true;
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }
}
