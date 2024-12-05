<?php
namespace App\Models;
use App\Commons\Model;
class OrderItem extends Model
{
    protected string $tableName = 'order_items';
    public function findByOrderId($orderId)
    {
        try {
            return $this->queryBuilder
                ->select(
                    'oi.id as oi_id',
                    'oi.order_id as oi_order_id',
                    'oi.product_variant_id as oi_product_variant_id',
                    'oi.quatity as oi_quatity',
                    'oi.product_name as oi_product_name',
                    'oi.product_sku as oi_product_sku',
                    'oi.product_thumb_image as oi_product_thumb_image',
                    'oi.product_price_regular as oi_product_price_regular',
                    'oi.product_price_sale as oi_product_price_sale',
                    'oi.variant_color_name as oi_variant_color_name',
                    'oi.created_at as oi_created_at',
                    'o.order_code as o_order_code',
                    'o.user_id as o_user_id',
                    'o.user_name as o_user_name',
                    'o.user_email as o_user_email',
                    'o.user_phone as o_user_phone',
                    'o.user_address as o_user_address',
                    'o.status_order as o_status_order',
                    'o.status_payment as o_status_payment',
                    'o.total_price as o_total_price',
                    'o.created_at as o_created_at',
                )
                ->from($this->tableName, 'oi')
                ->innerJoin('oi', 'orders', 'o', 'oi.order_id = o.id')
                ->where('order_id = :orderId')
                ->setParameter('orderId', $orderId)
                ->fetchAllAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}