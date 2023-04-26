<?php

class Database
{

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "company";
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        if (!$this->conn) {
            die("Error connect : " . mysqli_connect_error());
        }
    }

    public function insert($sql)
    {
        if (mysqli_query($this->conn, $sql)) {
            return "Added";
        } else {
            die("Error :" . mysqli_error($this->conn));
        }
    }


    public function enc_password($password)
    {
        $enc_password = sha1($password);
        return $enc_password;
    }


    public function read($tabel)
    {
        $sql = "SELECT * FROM $tabel";
        $result = mysqli_query($this->conn, $sql);
        $data = [];
        if ($result) {
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            return $data;
        } else {
            die("Error :" . mysqli_error($this->conn));
        }
    }


    public function find($table, $id)
    {
        // Use prepared statement to prevent SQL injection attacks
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE `id`=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        } else {
            die("Error: " . $this->conn->error);
        }
    }









    public function update($sql)
    {
        if (mysqli_query($this->conn, $sql)) {
            return "Updated";
        } else {
            die("Error :" . mysqli_error($this->conn));
        }
    }
    public function delete($table, $id)
    {
        // Use prepared statement to prevent SQL injection attacks
        $stmt = $this->conn->prepare("DELETE FROM $table WHERE `id`=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Deleted";
        } else {
            die("Error: " . $this->conn->error);
        }
    }
}
