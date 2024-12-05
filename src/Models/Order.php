<?php

namespace App\Models;

use App\Commons\Model;

class Order extends Model
{
    protected string $tableName = 'orders';

    public const STATUS_ORDER = [
        'pending'           => 'Chờ xác nhận',
        'confirmed'         => 'Đã xác nhận',
        'preparing_goods'   => 'Đang chuẩn bị hàng',
        'shipping'          => 'Đang vận chuyển',
        'delivered'         => 'Đã giao hàng',
        'canceled'          => 'Đơn hàng đã bị hủy',
    ];

    public const STATUS_PAYMENT = [
        'unpaid'            => "Chưa thanh toán",
        'paid'              => "Đã thanh toán"
    ];

    public const STATUS_ORDER_PENDING = 'pending';
    public const STATUS_ORDER_CONFIRMED = 'confirmed';
    public const STATUS_ORDER_PREPARING_GOODS = 'preparing_goods';
    public const STATUS_ORDER_SHIPPING = 'shipping';
    public const STATUS_ORDER_DELIVERED = 'delivered';
    public const STATUS_ORDER_CANCELED = 'canceled';
    public const STATUS_PAYMENT_UNPAID = 'unpaid';
    public const STATUS_PAYMENT_PAID = 'paid';

    public function findByUserId($userId)
    {
        try {
            return $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where('user_id = :userId')
                ->setParameter('userId', $userId)
                ->fetchAllAssociative();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function selectAndGetCount()
    {
        try {
            $query = clone ($this->queryBuilder);

            $data = $query
                ->select(
                    'o.id as o_id',
                    'o.order_code as o_order_code',
                    'o.user_id as o_user_id',
                    'o.user_name as o_user_name',
                    'o.user_email as o_user_email',
                    'o.user_phone as o_user_phone',
                    'o.user_address as o_user_address',
                    'o.user_note as o_user_note',
                    'o.ship_user_name as o_ship_user_name',
                    'o.ship_user_email as o_ship_user_email',
                    'o.ship_user_phone as o_ship_user_phone',
                    'o.ship_user_address as o_ship_user_address',
                    'o.ship_user_note as o_ship_user_note',
                    'o.is_same_buyer as o_is_same_buyer',
                    'o.status_order as o_status_order',
                    'o.status_payment as o_status_payment',
                    'o.total_price as o_total_price',
                    'o.created_at as o_created_at',
                    'COUNT(o.id) as oi_count_record'
                )
                ->from($this->tableName, 'o')
                ->innerJoin('o', 'order_items', 'oi', 'o.id = oi.order_id')
                ->groupBy('o.id')
                ->fetchAllAssociative();
            return $data;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function updateStatusOrder($id, $status)
    {
        try {
            $query = $this->queryBuilder->update($this->tableName);

            $query
                ->set('status_order', ':statusOrder')->setParameter('statusOrder', $status)
                ->where('id = :id', $id)->setParameter('id', $id)
                ->executeQuery();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}
