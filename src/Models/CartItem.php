<?php

namespace App\Models;

use App\Commons\Model;

class CartItem extends Model
{
    protected string $tableName = 'cart_items';

    public function findByCartIdAndProductId($cartId, $productId)
    {
        try {
            return $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where('cart_id = :cartId')
                ->andWhere('product_variant_id = :productId')
                ->setParameter('cartId', $cartId)
                ->setParameter('productId', $productId)
                ->fetchAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function updateQuantityByCartIdAndProductVariantId($cartId, $variantId, $quantity)
    {
        try {
            $query = $this->queryBuilder->update($this->tableName);

            $query
                ->set('quantity', '?')->setParameter(0, $quantity)
                ->where('cart_id = ?')->setParameter(1, $cartId)
                ->andWhere('product_variant_id = ?')->setParameter(2, $variantId)
                ->executeQuery();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function getCount($cartId)
    {
        try {
            return $this->queryBuilder
                ->select('COUNT(*)')
                ->from($this->tableName)
                ->where('cart_id = :cartId')
                ->setParameter('cartId', $cartId)
                ->fetchOne();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function selectInnerJoinProduct($cartId)
    {
        try {
            return $this->queryBuilder
                ->select(
                    'ct.id as ct_id',
                    'ct.product_variant_id as ct_product_variant_id',
                    'ct.quantity as ct_quantity',
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
                ->from($this->tableName, 'ct')
                ->innerJoin('ct', 'product_variants', 'v', 'ct.product_variant_id = v.id')
                ->innerJoin('v', 'product_colors', 'pc', 'v.product_color_id = pc.id')
                ->innerJoin('v', 'products', 'p', 'v.product_id = p.id')
                ->where('ct.cart_id = ?')
                ->setParameter(0, $cartId)
                ->fetchAllAssociative();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
