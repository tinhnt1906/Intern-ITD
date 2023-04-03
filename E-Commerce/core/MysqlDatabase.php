<?php
class MysqlDatabase extends database
{
    public $connect;

    public function __construct()
    {
        global $db_host, $db_user, $db_password, $db_database;

        $this->connect = new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_database
        );

        if ($this->connect->connect_error) {
            die("Kết Nối Thất Bại");
        }
    }

    public function table($tableName)
    {
        $this->table = $tableName;
        return $this;
    }

    public function get($limit = 10)
    {
        $sql = "SELECT * FROM $this->table ORDER BY id desc limit ?";
        $query = $this->connect->prepare($sql);
        $query->bind_param('i', $limit);
        $query->execute();
        $result = $query->get_result();
        $data = [];
        while ($each = $result->fetch_object()) {
            $data[] = $each;
        }
        return $data;
    }

    public function where($data)
    {
        $keyValues = [];
        foreach ($data as $key => $value) {
            $keyValues[] = $key . '=?';
        }
        $setFields = implode(' AND ', $keyValues);
        $sql = "SELECT * FROM $this->table where $setFields";
        $values = array_values($data);
        $query = $this->connect->prepare($sql);
        $query->bind_param(str_repeat('s', count($data)), ...$values);
        $query->execute();
        $result = $query->get_result();
        $data = [];
        while ($each = $result->fetch_object()) {
            $data[] = $each;
        }
        return $data;
    }

    public function count()
    {
        $sql = "select * from $this->table";
        $query = $this->connect->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $rows = $result->num_rows;
        return $rows;
    }


    public function getId($id)
    {
        $sql = "select * from $this->table where id = ?";
        $query = $this->connect->prepare($sql);
        $query->bind_param('i', $id);
        $query->execute();
        $result = $query->get_result();
        $data = [];
        while ($each = $result->fetch_object()) {
            $data[] = $each;
        }
        return $data;
    }

    public function create($data)
    {
        $fields = implode(',', array_keys($data));
        $valueStr = implode(',', array_fill(0, count($data), '?'));
        $values = array_values($data);
        $sql = "INSERT INTO $this->table ($fields) values ($valueStr)";
        $query = $this->connect->prepare($sql);
        $query->bind_param(str_repeat('s', count($data)), ...$values);
        $query->execute();
        return $query->affected_rows;
    }

    public function update($id, $data)
    {
        $keyValues = [];
        foreach ($data as $key => $value) {
            $keyValues[] = $key . '=?';
        }
        $setFields = implode(',', $keyValues);

        $sql = "Update $this->table set $setFields where id = ?";
        $query = $this->connect->prepare($sql);
        //get values
        $values = array_values($data);
        $values[] = $id;
        $query->bind_param(str_repeat("s", count($data)) . 'i', ...$values);
        $result = $query->execute();
        return $query->affected_rows;
    }

    public function updateToken($id, $data)
    {
        $keyValues = [];
        foreach ($data as $key => $value) {
            $keyValues[] = $key . '=?';
        }
        $setFields = implode(',', $keyValues);

        $sql = "Update $this->table set $setFields where verify_token = ?";
        $query = $this->connect->prepare($sql);
        //get values
        $values = array_values($data);
        $values[] = $id;
        $query->bind_param(str_repeat("s", count($data)) . 's', ...$values);
        $result = $query->execute();
        return $query->affected_rows;
    }

    public function delete($id)
    {
        $sql = "delete from $this->table where id = ?";
        $query = $this->connect->prepare($sql);
        $query->bind_param('i', $id);
        $query->execute();
        return $this->connect->affected_rows;
    }
}