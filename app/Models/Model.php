<?php

namespace App\Models;

use Database\DBConnection;
use PDO;

abstract class Model
{
    protected DBConnection $db;

    protected string $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    /**
     * @return bool|array
     */
    public function all(): bool|array
    {
        return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
    }

    /**
     * @param int $id
     * @return Model|Null
     */
    public function findById(int $id): Model|Null
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1",[$id],true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    /**
     * @param int $id
     * @param array $data
     * @param array|null $relations
     * @return mixed
     */
    public function update(int $id, array $data, ?array $relations = null): mixed
    {
        $fieldsList = "";
        $i = 1;

        foreach (array_keys($data) as $field){
            $comma = $i === count($data) ? " " : ", ";
            $fieldsList .= "{$field} = :{$field}{$comma}";
            $i++;
        }
        $data['id'] = $id;
        $sql = "UPDATE {$this->table} SET {$fieldsList} WHERE id = :id";

        return $this->query($sql, $data);
    }

    /**
     * @param array $data
     * @param array|null $relations
     * @return mixed
     */
    public function create(array $data, ?array $relations = null): mixed
    {
        $fieldsList = "";
        $paramsList = "";
        $i = 1;

        foreach (array_keys($data) as $field){
            $comma = $i === count($data) ? "" : ", ";
            $fieldsList .= "{$field}{$comma}";
            $paramsList .= ":{$field}{$comma}";
            $i++;
        }
        $sql = "INSERT INTO {$this->table} ({$fieldsList}) VALUES ({$paramsList})";
        return $this->query($sql, $data);
    }

    /**
     * @param string $sql
     * @param array|null $attributes
     * @param bool|null $single
     * @return mixed
     */
    public function query(string $sql, array $attributes = null, bool $single = null): mixed
    {
        $type = $attributes ?  'prepare' :  'query';

        if (strpos($sql,'DELETE')  === 0
            || strpos($sql,'UPDATE') === 0
            || strpos($sql,'INSERT') === 0) {

            $stmt = $this->db->getPDO()->$type($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            return $stmt->execute($attributes);
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        $stmt = $this->db->getPDO()->$type($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if($type === 'prepare'){
            $stmt->execute($attributes);
            return $stmt->$fetch();
        }
        return $stmt->$fetch();
    }

}