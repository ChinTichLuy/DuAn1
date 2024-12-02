<?php

namespace App\Models;

use App\Commons\Model;

class User extends Model
{
    protected string $tableName = 'users';

    public function emailExists($email, $ignoreId = null)
    {
        try {
            $query = $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where('email = :email')
                ->setParameter('email', $email);

            if ($ignoreId) {
                $query->andWhere('id != :id')->setParameter('id', $ignoreId);
            };

            $res = $query->executeQuery()->fetchAssociative();
            return $res !== false;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function findByEmail($email)
    {
        try {
            return $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where('email = :email')
                ->setParameter('email', $email)
                ->fetchAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}
