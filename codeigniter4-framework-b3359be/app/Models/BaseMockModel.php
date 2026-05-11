<?php

namespace App\Models;

class BaseMockModel
{
    protected $table;
    protected $primaryKey = 'id';
    protected $whereKey = null;
    protected $whereValue = null;

    private function getFilePath()
    {
        return WRITEPATH . 'mock_db_' . $this->table . '.json';
    }

    private function loadData()
    {
        $file = $this->getFilePath();
        if (!file_exists($file)) {
            return [];
        }
        $content = file_get_contents($file);
        return json_decode($content, true) ?: [];
    }

    private function saveData($data)
    {
        $file = $this->getFilePath();
        file_put_contents($file, json_encode(array_values($data), JSON_PRETTY_PRINT));
    }

    public function where($key, $value)
    {
        $this->whereKey = $key;
        $this->whereValue = $value;
        return $this;
    }

    public function first()
    {
        $data = $this->loadData();
        foreach ($data as $item) {
            if ($this->whereKey && isset($item[$this->whereKey]) && $item[$this->whereKey] == $this->whereValue) {
                $this->resetQuery();
                return $item;
            }
        }
        $this->resetQuery();
        return null;
    }

    public function find($id)
    {
        $data = $this->loadData();
        foreach ($data as $item) {
            if (isset($item[$this->primaryKey]) && $item[$this->primaryKey] == $id) {
                return $item;
            }
        }
        return null;
    }

    public function findAll()
    {
        return $this->loadData();
    }

    public function insert($row, $returnId = false)
    {
        $data = $this->loadData();
        $id = 1;
        if (count($data) > 0) {
            $last = end($data);
            $id = isset($last[$this->primaryKey]) ? $last[$this->primaryKey] + 1 : count($data) + 1;
        }
        $row[$this->primaryKey] = $id;
        $data[] = $row;
        $this->saveData($data);
        return $returnId ? $id : true;
    }

    public function update($id, $row)
    {
        $data = $this->loadData();
        foreach ($data as &$item) {
            if (isset($item[$this->primaryKey]) && $item[$this->primaryKey] == $id) {
                foreach ($row as $k => $v) {
                    $item[$k] = $v;
                }
                break;
            }
        }
        $this->saveData($data);
        return true;
    }
    
    public function delete($id = null)
    {
        if ($id === null) return false;
        $data = $this->loadData();
        $newData = [];
        foreach ($data as $item) {
            if (isset($item[$this->primaryKey]) && $item[$this->primaryKey] == $id) {
                continue;
            }
            $newData[] = $item;
        }
        $this->saveData($newData);
        return true;
    }

    private function resetQuery()
    {
        $this->whereKey = null;
        $this->whereValue = null;
    }
}
