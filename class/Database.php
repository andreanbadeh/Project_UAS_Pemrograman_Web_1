<?php
class Database {
    protected $conn;

    public function __construct()
    {
        include __DIR__ . "/../config/koneksi.php";
        $this->conn = $conn;
    }

    public function query($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

    public function getAll($table)
    {
        return mysqli_query($this->conn, "SELECT * FROM $table");
    }

    public function getById($table, $id_field, $id)
    {
        $q = mysqli_query($this->conn, "SELECT * FROM $table WHERE $id_field='$id'");
        return mysqli_fetch_assoc($q);
    }

    public function insert($table, $data)
    {
        $columns = implode(",", array_keys($data));
        $values  = "'" . implode("','", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return mysqli_query($this->conn, $sql);
    }

    public function update($table, $data, $where)
    {
        $set = [];
        foreach ($data as $k => $v) {
            $set[] = "$k='$v'";
        }
        $set = implode(",", $set);

        $sql = "UPDATE $table SET $set WHERE $where";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($table, $where)
    {
        return mysqli_query($this->conn, "DELETE FROM $table WHERE $where");
    }
}
?>
