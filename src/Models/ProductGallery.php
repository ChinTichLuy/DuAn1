<?php 
namespace App\Models;

use App\Commons\Model;

class ProductGallery extends Model{
    protected string $tableName = "product_galleries";

    public function findByProductId($productId)
    {
        try {
            return $this->queryBuilder
            ->select('id', 'image')
            ->from($this->tableName)
            ->where('product_id = :productId')
            ->setParameter('productId', $productId)
            ->fetchAllAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

}