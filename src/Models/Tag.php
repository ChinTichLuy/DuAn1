<?php 
namespace App\Models;

use App\Commons\Model;

class Tag extends Model{
    protected string $tableName = "tags";

    public function findByName($name)
    {
        try {
            return $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where('name = :name')
                ->setParameter('name', $name)
                ->fetchAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}