<?php
namespace App\Controllers\Client;
use App\Commons\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
class CheckOutController extends Controller
{
    private const PATH_VIEW = 'checkout';
    private Cart $cart;
    private CartItem $cartItem;
    private Order $order;
    private OrderItem $orderItem;
    public function __construct()
    {
        middleware_private_for_admin();
        $this->cart = new Cart();
        $this->cartItem = new CartItem();
        $this->order = new Order();
        $this->orderItem = new OrderItem();
    }
    public function index()
    {
        $authenTication = 26;
        if ($authenTication == 26) {
            $cart = $this->cart->findByUserId($authenTication);
            $data = $this->cartItem->selectInnerJoinProduct($cart['id']);
            $total = calculateTotalProduct($data);
        } else {
            $data = [];
            $total = 0;
        }
        // dd($data);
        return $this->viewClient(self::PATH_VIEW, [
            'data' => $data,
            'total' => $total
        ]);
    }
    public function add()
    {
        // dd($_POST);
        $authenTication = 26;
        if ($authenTication == 26) {
            $cart = $this->cart->findByUserId($authenTication);
            $data = $this->cartItem->selectInnerJoinProduct($cart['id']);
            $total = calculateTotalProduct($data);
        } else {
            $data = [];
            $total = 0;
        }
        if ($_POST['payment'] == 0) {
            if ($authenTication !== 26) {
                // người dùng chưa có tài khoản
            } else {
                // lấy connect của order
                $connect = $this->order->getConnect();
                $this->order->insert([
                    'user_id' => $authenTication,
                    'user_name' => $_POST['user_name'],
                    'user_email' => $_POST['user_email'],
                    'user_phone' => $_POST['user_phone'],
                    'user_address' => $_POST['user_address'],
                    'user_note' => $_POST['user_note'],
                    'total_price' => $total,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $orderId = $connect->lastInsertId();
                foreach ($data as $product) {
                    $this->orderItem->insert([
                        'order_id' => $orderId,
                        'product_variant_id' => $product['ct_product_variant_id'],
                        'quatity' => $product['ct_quantity'],
                        'product_name' => $product['p_name'],
                        'product_sku' => $product['p_sku'],
                        'product_thumb_image' => $product['p_thumb_image'],
                        'product_price_regular' => $product['p_price_regular'],
                        'product_price_sale' => $product['p_price_sale'],
                        'variant_color_name' => $product['pc_name'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                if ($authenTication == 26) {
                    $this->cartItem->deleteCartItemByCartId($cart['id']);
                }
                return header('location: ' . routeClient('cart'));
            }
        } else {
            $_SESSION['data_checkout'] = [
                'post' => $_POST,
                'data' => $data,
                'total' => $total
            ];
            momo($_POST['total_price']);
        }
    }
    public function handleMomo()
    {
        $message = $_GET['message'] ?? 'Giao dịch bị từ chối bởi người dùng.';
        $resultCode = $_GET['resultCode'] ?? null;
        $authenTication = 26; // thay bằng id của user sau khi login
        if ($resultCode != 0) {
            return header('location: ' . routeClient('checkout'));
        }
        if ($authenTication != 26) {
            // logic cho người dùng k có tài khoản
            echo 1;
        }
        $cart = $this->cart->findByUserId($authenTication);
        // $data = $this->cartItem->selectInnerJoinProduct($cart['id']);
        // dd($data);
        // Nếu người dùng chưa có địa chỉ bắt nhập địa chỉ từ form lên
        // Nếu người dùng đã có địa chỉ thì truyền địa chỉ vào
        // dd($_SESSION);
        $connect = $this->order->getConnect();
        $this->order->insert([
            'user_id' => $authenTication,
            'user_name' => 'nguoi dung 1',
            'user_email' => 'nguoidung1@gmail.com',
            'user_phone' => '0367253666',
            'user_address' => 'Hoài Đức - Hà Nội',
            'user_note' => 'Nếu không thấy nghe máy. Vui lòng gọi sdt 0367253666',
            'total_price' => $_SESSION['data_checkout']['total'],
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s'),
        ]);
        $orderId = $connect->lastInsertId();
        
        // create date from db
        foreach ($_SESSION['data_checkout']['data'] as $value) {
            $this->orderItem->insert([
                'order_id' => $orderId,
                'product_variant_id' => $value['ct_product_variant_id'],
                'quatity' => $value['ct_quantity'],
                'product_name' => $value['p_name'],
                'product_sku' => $value['p_slug'],
                'product_thumb_image' => $value['p_thumb_image'],
                'product_price_regular' => $value['p_price_regular'],
                'product_price_sale' => $value['p_price_sale'],
                'variant_color_name' => $value['pc_name'],
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
            ]);
        }
        $this->cartItem->deleteCartItemByCartId($cart['id']);
        unset($_SESSION['data_checkout']);
    }
}