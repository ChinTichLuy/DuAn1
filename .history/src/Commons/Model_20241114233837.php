<?php
namespace App\Commons;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;

class Model{

    protected Connection|null $connect;
	protected QueryBuilder $queryBuilder;
	protected string $tableName;
	protected const PER_PAGE = 10;

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