<?php
include_once("db.php"); 

class Province {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        try {
            $sql = "INSERT INTO province(name) VALUES(:province_name);";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':province_name', $data['name']);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                return $this->db->getConnection()->lastInsertId();
            }

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();
            throw $e; 
        }
    }

    public function read($id) {
        try {
            $connection = $this->db->getConnection();

            $sql = "SELECT * FROM province WHERE id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $prov = $stmt->fetch(PDO::FETCH_ASSOC);

            return $prov;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; 
        }
    }

    public function update($id, $data) {
        try {
            $sql = "UPDATE province SET
                    name = :name
                    WHERE id = :id";

            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':name', $data['name']);

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; 
        }
    }
    public function delete($id) {
        try {
            $sql = "DELETE FROM province where id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindValue(':id',$id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false; 
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e;
        }
    }

    public function displayLimit($page_first_result,$rows_per_page) {
        try {
            $sql = "SELECT * FROM province LIMIT " . $page_first_result . "," . $rows_per_page;
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; 
        }
    }

    public function displayAll() {
        try {
            $sql = "SELECT * FROM province";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e;
        }
    }
}
?>