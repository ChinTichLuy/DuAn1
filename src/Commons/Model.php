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

	public function insert(array $data)
	{
		if (!empty($data)) {
			$query = $this->queryBuilder->insert($this->tableName);

			$index = 0;
			foreach ($data as $key => $value) {
				$query->setValue($key, '?')->setParameter($index, $value);
				++$index;
			}

			$query->executeQuery();

			return true;
		}

		return false;
	}

	public function update($id,	array $data)
	{
		if (!empty($data)) {
			$query = $this->queryBuilder->update($this->tableName);

			$index = 0;
			foreach ($data as $key => $value) {
				$query->set($key, '?')->setParameter($index, $value);

				++$index;
			}

			$query->where('id = ?')
				->setParameter(count($data), $id)
				->executeQuery();

			return true;
		}

		return false;
	}

	public function delete($id)
	{
		try {
			return $this->queryBuilder
				->delete($this->tableName)
				->where('id = :id')
				->setParameter('id', $id)
				->executeQuery();
		} catch (\Exception $e) {
			die("LuxChill: " . $e->getMessage());
		}
	}


	// xóa mềm demo - chuyển deleted_at từ 0 -> 1
	public function delete2($id)
	{
		try {
			return $this->queryBuilder
				->update($this->tableName)
				->set('deleted_at', '?')
				->where('id = ?')
				->setParameter('0', true)
				->setParameter('1', $id)
				->executeQuery();
		} catch (\Throwable $th) {
			die($th->getMessage());
		}
	}

	public function __destruct()
	{
		$this->connect = null;
	}


	// public function (){}
}
