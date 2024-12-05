<?php

namespace App\Models;

use App\Commons\Model;

class ProductVariants extends Model
{
    protected string $tableName = "product_variants";

    public function findByProductId($productId)
    {
        try {
            return $this->queryBuilder
                ->select(
                    'v.id as v_id',
                    'v.product_color_id as v_product_color_id',
                    'v.quatity as v_quatity',
                    'v.price_regular as v_price_regular',
                    'v.price_sale as v_price_sale',
                    'c.name as c_name',
                )
                ->from($this->tableName, 'v')
                ->innerJoin('v', 'product_colors', 'c', 'v.product_color_id = c.id')
                ->where('v.product_id = :productId')
                ->setParameter('productId', $productId)
                ->fetchAllAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
    public function findByColorId($productId, $colorId)
    {
        try {
            return $this->queryBuilder
                ->select('id')
                ->from($this->tableName)
                // ->where('product_color_id = :colorId')
                // ->where('product_id = :productId')
                // ->setParameter('productId', $productId)
                // ->setParameter('colorId', $colorId)
                ->where('product_id = :productId', 'product_color_id = :colorId')
                ->setParameters([
                    'productId' => $productId,
                    'colorId' => $colorId,
                ])
                ->fetchAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function findById($productVariantId)
    {
        $query  = clone ($this->queryBuilder);
        try {
            // products
            // variants
            // product_colors
            $data = $query
                ->select(
                    'v.product_color_id as v_product_color_id',
                    'v.product_id as v_product_id',
                    'v.price_regular as v_price_regular',
                    'v.price_sale as v_price_regular',
                    'v.quatity as v_quatity',
                    'pc.id as pc_id',
                    'pc.name as pc_name',
                    'p.name as p_name',
                    'p.slug as p_slug',
                    'p.sku as p_sku',
                    'p.thumb_image as p_thumb_image',
                    'p.price_regular as p_price_regular',
                    'p.price_sale as p_price_sale'
                )
                ->from($this->tableName, 'v')
                ->innerJoin('v', 'products', 'p', 'v.product_id = p.id')
                ->innerJoin('v', 'product_colors', 'pc', 'v.product_color_id = pc.id')
                // ->innerJoin('p', 'products', 'p', 'v.product_id = p.id')
                ->where('v.id = :id')
                ->setParameter('id', $productVariantId)
                ->fetchAssociative();
            return $data;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}
