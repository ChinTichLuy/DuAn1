<?php
namespace App\Commons;

class Model{

    
    public function __construct(){

    }

    public function getConnect(){

    }

    public function getAll(...$columns)
	{
		try {
			return $this->queryBuilder
				->select(...$columns)
				->from($this->tableName)
				->fetchAllAssociative();
		} catch (Exception $e) {
			die("Err" . $e->getMessage());
		}
	}


}