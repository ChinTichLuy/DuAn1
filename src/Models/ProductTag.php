<?php 
namespace App\Models;

use App\Commons\Model;

class ProductTag extends Model{
    protected string $tableName = "product_tags";

    public function findByProductId($productId)
    {
        try {
            return $this->queryBuilder
            ->select('id', 'name')
            ->from($this->tableName, 'pt')
            ->innerJoin('pt', 'tags', 't', 'pt.tag_id = t.id')
            ->where('pt.product_id = :productId')
            ->setParameter('productId', $productId)
            ->fetchAllAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

}