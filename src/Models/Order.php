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
}
