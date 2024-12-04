<?php
namespace App\Models;
use App\Commons\Model;
class CartItem extends Model{
    protected string $tableName = 'cart_items';

    public function selectInnerJoinProduct($cartId)
    {
        $query  = clone ($this->queryBuilder);
        try {
            $data = $query
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
                ->where('ct.cart_id = :cartId')
                ->setParameter('cartId', $cartId)
                ->fetchAllAssociative();

            return $data;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function deleteCartItemByCartId($cartId)
    {
        try {
            return $this->queryBuilder
                ->delete($this->tableName)
                ->where('cart_id = :cartId')
                ->setParameter('cartId', $cartId)
                ->executeQuery();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}