<?php
class Database {
    private string $host="localhost";
    private string $db_name="crud_mvc";
    private string $username="root";
    private string $password="";
    private ?PDO $conn=null;
     public function getConnection():PDO{
        if($this->conn==null){
            $this->conn=new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
                ); 
        }
        return $this->conn;
     }
}
?>