<?php

namespace App\Models;

use App\Commons\Model;

class Cart extends Model
{
    protected string $tableName = 'carts';

    // public function findByUserId($userId)
    // {
    //     $record =  $this->queryBuilder
    //         ->select(1)
    //         ->from($this->tableName)
    //         ->where('user_id = :userId')
    //         ->setParameter('userId', $userId)
    //         ->setMaxResults(1)
    //         ->fetchOne();

    //     return (bool) $record;
    // }

    public function findByUserId($userId)
    {
        try {
            return $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where('user_id = :userId')
                ->setParameter('userId', $userId)
                ->fetchAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    
}