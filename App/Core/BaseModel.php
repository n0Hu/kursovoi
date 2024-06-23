<?php
namespace App\Core;

use PDO;

abstract class BaseModel {
    public $model;
    private $db = null;

    public function __construct($isConnecting = true) {
        if($isConnecting) $this->connectDB();
    }

    public function getInstanceDB() {
        return $this->db;
    }

    public function connectDB() {
        global $CONFIG_DATABASE;
        try {
            $this->db = new PDO('mysql:host='.$CONFIG_DATABASE['host'].';dbname='.$CONFIG_DATABASE['dbname'] . ';charset=utf8', $CONFIG_DATABASE['login'], $CONFIG_DATABASE['password']);
        } catch(\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function closeDB() {
        $this->db = null;
    }

    public function sendSQL($sql, $inputData = null) {
        if(is_null($this->db)) return false;

        $statement = $this->db->prepare($sql);
        return $statement->execute($inputData);
    }

    public function sendSQLGetData($sql, $inputData = null) {
        if(is_null($this->db)) return null;

        $statement = $this->db->prepare($sql);
        $statement->execute($inputData);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendSQLGetID($sql, $inputData = null) {
        if(is_null($this->db)) return null;

        $statement = $this->db->prepare($sql);
        if($statement->execute($inputData)) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function getAll() {
        return $this->sendSQLGetData("SELECT * FROM {$this->model} ORDER BY id ASC");
    }

    public function getAllWithUserID($userID) {
        return $this->sendSQLGetData("SELECT * FROM {$this->model} WHERE user_id = :user_id ORDER BY id ASC", ['user_id' => $userID]);
    }

    public function getByID($id) {
        return $this->sendSQLGetData("SELECT * FROM {$this->model} WHERE id = :id", ['id' => $id]);
    }

    public function update($id, $data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
            if(!$value) {
                $value = null;
            }
        }

        $sql = "UPDATE {$this->model} SET ";
        foreach(array_keys($data) as $field) {
            if($field !== 'id') {
                $sql .= "{$field} = :{$field}, ";
            }
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE id = :id";

        $this->sendSQL($sql, $data);
    }

    public function delete($id) {
        return $this->sendSQL("DELETE FROM {$this->model} WHERE id = :id", [ 'id' => $id ]);
    }

    abstract function create($data);
}
?>