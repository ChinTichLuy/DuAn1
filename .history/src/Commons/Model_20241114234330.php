<?php

namespace App\Commons;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;

class Model
{

	protected Connection|null $connect;
	protected QueryBuilder $queryBuilder;
	protected string $tableName;
	protected const PER_PAGE = 10;

	public function __construct()
	{
		$connectionParams = [
			'dbname' => $_ENV['DB_NAME'],
			'user' => $_ENV['DB_USERNAME'],
			'password' => $_ENV['DB_PASSWORD'],
			'host' => $_ENV['DB_HOST'],
			'port' => $_ENV['DB_PORT'],
			'driver' => $_ENV['DB_DRIVER'],
		];
		$this->connect = DriverManager::getConnection($connectionParams);
		$this->queryBuilder = $this->connect->createQueryBuilder();
	}

	public function getConnect()
	{
		return $this->connect;
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


	public function find($id)
	{
		try {
			return $this->queryBuilder
				->select('*')
				->from($this->tableName)
				->where('id = :id')
				->setParameter("id", $id)
				->fetchAssociative();
		} catch (Exception $e) {
			die("Err" . $e->getMessage());
		}
	}

	public function count()
	{
		try {
			return $this->queryBuilder
				->select("COUNT(*)")
				->from($this->tableName)
				->fetchOne();
		} catch (\Exception $e) {
			die("LuxChill: " . $e->getMessage());
		}
	}

	public function paginate($page = 1, $perPage =  self::PER_PAGE)
	{
		$queryBuilder = clone ($this->queryBuilder);
		$totalPage = ceil($this->count() / $perPage);
		$offset = $perPage * ($page - 1);
		try {
			$data = $queryBuilder
				->select('*')
				->from($this->tableName)
				->setFirstResult($offset)
				->setMaxResults($perPage)
				->orderBy('id', 'DESC')
				->fetchAllAssociative();

			return [$data, $totalPage];
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	

	// public function (){}
}
