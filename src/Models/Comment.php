<?php
namespace App\Models;

use App\Commons\Model;
use Exception;

class Comment extends Model
{
    protected string $tableName = 'comments';


    public function selectAllInnerJoin($page = 1, $perPage = self::PER_PAGE)
    {
        $queryBuilder = clone ($this->queryBuilder);
        $totalPage = ceil($this->count() / $perPage);
        $offset = $perPage * ($page - 1);
        try {
            $data = $queryBuilder
                ->select('c.id as c_id', 'u.name as u_name', 'p.name as p_name', 'c.rating as c_rating', 'c.created_at as c_created_at', 'c.updated_at as c_updated_at')
                ->from($this->tableName, 'c')
                ->innerJoin('c', 'users', 'u', 'c.user_id = u.id')
                ->innerJoin('c', 'products', 'p', 'c.product_id = p.id')
                ->setFirstResult($offset)
                ->setMaxResults($perPage)
                ->orderBy('c.id', 'DESC')
                ->fetchAllAssociative();
            return [$data, $totalPage];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}