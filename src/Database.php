<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 08.04.17
 * Time: 00:03
 */

require_once 'config.php';

class Database
{
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
    }

    public function findById($id, $table)
    {
        $query = "SELECT * FROM {$table} WHERE id={$id}";
        $result = $this->connection->query($query);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }
    }

    public function findByParameter($table, $param, $paramValue)
    {
        $results = [];
        $query = "SELECT * FROM {$table} WHERE {$param}=\"{$paramValue}\"";
        $result = $this->connection->query($query);
        if ($result && $result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        } else {
            return false;
        }
        return $results;
    }

    public function save($itemData, $table)
    {
        if ($itemData['id'] == -1) {
            $query = "INSERT INTO {$table} (";
            foreach ($itemData as $key => $value) {
                if ($key != 'id') {
                    $query .= "{$key}, ";
                }
            }
            $query = rtrim($query, ", ");
            $query .= ") VALUES (";
            foreach ($itemData as $key => $value) {
                if ($key != 'id') {
                    $query .= "\"{$value}\", ";
                }
            }
            $query = rtrim($query, ", ");
            $query .= ")";
            $result = $this->connection->query($query);
        } else {
            $query = "UPDATE {$table} SET ";
            foreach ($itemData as $key => $value) {
                if ($key != 'id') {
                    $query .= "{$key}=\"{$value}\", ";
                }
            }
            $query = rtrim($query, ', ');
            $query .= " WHERE id={$itemData['id']}";
            $result = $this->connection->query($query);
        }

        if($this->connection->error) {
            printf("\n" . $this->connection->error . "\n");
        }
        return $this->connection->insert_id;
    }

}