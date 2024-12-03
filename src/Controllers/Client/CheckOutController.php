<?php

namespace App\Controllers\Client;

use App\Commons\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class CheckOutController extends Controller
{
    private const PATH_VIEW = 'checkout';

    private Cart $cart;
    private CartItem $cartItem;
    private Order $order;

    private OrderItem $orderItem;
    private User $user;

    public function __construct()
    {
        parent::__construct();
        $this->cart = new Cart();
        $this->cartItem = new CartItem();
        $this->order = new Order();
        $this->orderItem = new OrderItem();
        $this->user = new User();
    }

    public function index()
    {

        $authenTication = 26;

        $userId = $_SESSION['user']['id'] ?? null;

        if ($userId) {
            $cart = $this->cart->findByUserId($userId);
            $data = $this->cartItem->selectInnerJoinProduct($cart['id']);
            $total = calculateTotalProduct($data);
        } else {
            $data = $_SESSION['cart'] ?? [];
            $total = calculateTotalProduct($data);
        }

        ## Nếu data rỗng trở về trang shop
        if (empty($data)) {
            header('location: ' . routeClient('shop'));
            exit();
        }

        // dd($data);

        return $this->viewClient(self::PATH_VIEW, [
            'data' => $data,
            'total' => $total
        ]);
    }

    public function add()
    {


        ## Lấy ra id của user ?? nếu k có thì == null
        $userId = $_SESSION['user']['id'] ?? null;

        $authenTication = 26;

        if ($userId) {
            ## Nếu có người dùng thì tìm trong db
            $cart = $this->cart->findByUserId($userId);
            $data = $this->cartItem->selectInnerJoinProduct($cart['id']);
            $total = calculateTotalProduct($data);
        } else {
            ## Lấy data từ session ra
            $data = $_SESSION['cart'] ?? [];
            $total = calculateTotalProduct($data);
        }

        ## Tạo rule để validate
        $validation  = $this->validator->make($_POST, [
            'user_name' => 'required|max:255',
            'user_email' => 'required|email',
            'user_phone' => 'required',
            'user_address' => 'required',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            ## Nếu sai thì vào case này

            /**
             * Lưu những data post từ form lên => 
             * Nếu có lỗi sẽ dùng function trong helper để get ra truyền vào value input / Chỉ dùng 1 lần 
             */
            $_SESSION['old-data'] = $_POST;
            /**
             * Lưu lỗi vào session để hiện ra bên web
             */
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            toastr('error', 'Vui lòng nhập đủ thông tin');
            header('location: ' . routeClient('checkout'));
            exit();
        } else {
            ## Nếu người dùng chọn nhận hàng thanh toán
            if ($_POST['payment'] == 0) {

                if ($userId) {
                    // lấy connect của order

                    ## Code trước khi tối ưu

                    // $connect = $this->order->getConnect();

                    // $this->order->insert([
                    //     'user_id' => $authenTication,
                    //     'user_name' => $_POST['user_name'],
                    //     'user_email' => $_POST['user_email'],
                    //     'user_phone' => $_POST['user_phone'],
                    //     'user_address' => $_POST['user_address'],
                    //     'user_note' => $_POST['user_note'],
                    //     'total_price' => $total,
                    //     'created_at' => date('Y-m-d H:i:s'),
                    //     'updated_at' => date('Y-m-d H:i:s'),
                    // ]);

                    // $orderId = $connect->lastInsertId();

                    // foreach ($data as $product) {
                    //     $this->orderItem->insert([
                    //         'order_id' => $orderId,
                    //         'product_variant_id' => $product['ct_product_variant_id'],
                    //         'quatity' => $product['ct_quantity'],
                    //         'product_name' => $product['p_name'],
                    //         'product_sku' => $product['p_sku'],
                    //         'product_thumb_image' => $product['p_thumb_image'],
                    //         'product_price_regular' => $product['p_price_regular'],
                    //         'product_price_sale' => $product['p_price_sale'],
                    //         'variant_color_name' => $product['pc_name'],
                    //         'created_at' => date('Y-m-d H:i:s'),
                    //         'updated_at' => date('Y-m-d H:i:s'),
                    //     ]);
                    // }

                    // if ($authenTication == 26) {
                    //     $this->cartItem->deleteCartItemByCartId($cart['id']);
                    // }

                    ## End code trước khi tối ưu

                    // Start Tối Ưu

                    $orderId = $this->createOrder($userId, $_POST, $total);

                    $this->createOrderItem($orderId, $data);

                    $this->cartItem->deleteCartItemByCartId($cart['id']);

                    toastr('success', 'Cảm ơn bạn đã mua hàng');
                    header('location: ' . routeClient('cart'));
                    exit();
                }


                // dd($data);
                /**
                 * Role guest thì tạo account mới với is_active = 0
                 * Lấy id của user insert vào bảng order
                 * Nếu người dùng thêm cả địa chỉ thì thêm vào bảng user_address
                 */

                $connect = $this->user->getConnect();

                $this->user->insert([
                    'name' => $_POST['user_name'],
                    'email' => $_POST['user_email'],
                    'phone' => $_POST['user_phone'],
                    'is_active' => 0,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s'),
                ]);

                $userId = $connect->lastInsertId();

                $orderId = $this->createOrder($userId, $_POST, $total);
                // $this->createOrderItem($orderId, $data);

                ## @Logic truoc khi tối ưu
                // // Lấy connect của order
                // $connect = $this->order->getConnect();

                // /**
                //  * Dựa vào userId mới insert vào bảng user
                //  * Thêm data vào bảng order
                //  */

                // $this->order->insert([
                //     'user_id' => $userId,
                //     'user_name' => $_POST['user_name'],
                //     'user_email' => $_POST['user_email'],
                //     'user_phone' => $_POST['user_phone'],
                //     'user_address' => $_POST['user_address'],
                //     'user_note' => $_POST['user_note'] ?? null,
                //     'total_price' => $total,
                //     'created_at' => date('Y-m-d H:i:s'),
                //     'updated_at' => date('Y-m-d H:i:s'),
                // ]);

                // /**
                //  * Lấy connect của order
                //  */

                // $orderId = $connect->lastInsertId();

                // /**
                //  * Sau khi lấy được orderId thì insert data product vào bảng order_items
                //  */

                foreach ($data as $key => $item) {
                    $this->orderItem->insert([
                        'order_id' => $orderId,
                        'product_variant_id' => $key,
                        'quatity' => $item['ct_quantity'],
                        'product_name' => $item['p_name'],
                        'product_sku' => $item['p_sku'],
                        'product_thumb_image' => $item['p_thumb_image'],
                        'product_price_regular' => $item['p_price_regular'],
                        'product_price_sale' => $item['p_price_sale'],
                        'variant_color_name' => $item['pc_name'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }

                ## @Logic truoc khi tối ưu



                /**
                 * Sau khi thêm vào thành công thì xóa session cart
                 */
                unset($_SESSION['cart']);
                toastr('success', 'Cảm ơn bạn đã mua hàng');
                header('location: ' . routeClient('cart'));
                exit();

                ## Nếu người dùng chọn thanh toán momo
            } else {

                $_SESSION['data_checkout'] = [
                    'post' => $_POST,
                    'data' => $data,
                    'total' => $total
                ];

                momo($_POST['total_price']);
            }
        }
    }

    public function handleMomo()
    {
        $message = $_GET['message'] ?? 'Giao dịch bị từ chối bởi người dùng.';
        $resultCode = $_GET['resultCode'] ?? null;
        $authenTication = 26; // thay bằng id của user sau khi login
        $userId = $_SESSION['user']['id'] ?? null;


        if ($resultCode != 0) {
            toastr('error', $message);
            return header('location: ' . routeClient('checkout'));
        }

        if (!$userId) {
            // logic cho người dùng k có tài khoản
            $cart = $_SESSION['cart'] ?? [];

            $connect = $this->user->getConnect();

            $this->user->insert([
                'name' => $_SESSION['data_checkout']['post']['user_name'],
                'email' => $_SESSION['data_checkout']['post']['user_email'],
                'phone' => $_SESSION['data_checkout']['post']['user_phone'],
                'is_active' => 0,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
            ]);

            $userId = $connect->lastInsertId();

            $connect = $this->order->getConnect();

            $this->order->insert([
                'user_id' => $userId,
                'user_name' => $_SESSION['data_checkout']['post']['user_name'],
                'user_email' => $_SESSION['data_checkout']['post']['user_email'],
                'user_phone' => $_SESSION['data_checkout']['post']['user_phone'],
                'user_address' => $_SESSION['data_checkout']['post']['user_address'],
                'user_note' => $_SESSION['data_checkout']['post']['user_note'] ?? null,
                'status_payment' => 'paid',
                'total_price' => $_SESSION['data_checkout']['post']['total_price'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $orderId = $connect->lastInsertId();


            foreach ($cart as $key => $item) {
                $this->orderItem->insert([
                    'order_id' => $orderId,
                    'product_variant_id' => $key,
                    'quatity' => $item['ct_quantity'],
                    'product_name' => $item['p_name'],
                    'product_sku' => $item['p_sku'],
                    'product_thumb_image' => $item['p_thumb_image'],
                    'product_price_regular' => $item['p_price_regular'],
                    'product_price_sale' => $item['p_price_sale'],
                    'variant_color_name' => $item['pc_name'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }



            ## @Code trước khi tối ưu

            // // Lấy connect của order
            // $connect = $this->order->getConnect();

            // /**
            //  * Dựa vào userId mới insert vào bảng user
            //  * Thêm data vào bảng order
            //  */

            // $this->order->insert([
            //     'user_id' => $userId,
            //     'user_name' => $_SESSION['data_checkout']['post']['user_name'],
            //     'user_email' => $_SESSION['data_checkout']['post']['user_email'],
            //     'user_phone' => $_SESSION['data_checkout']['post']['user_phone'],
            //     'user_address' => $_SESSION['data_checkout']['post']['user_address'],
            //     'user_note' => $_SESSION['data_checkout']['post']['user_note'] ?? null,
            //     'total_price' => $_SESSION['data_checkout']['post']['total_price'],
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ]);

            // /**
            //  * Lấy connect của order
            //  */

            // $orderId = $connect->lastInsertId();

            // /**
            //  * Sau khi lấy được orderId thì insert data product vào bảng order_items
            //  */

            // foreach ($cart as $key => $item) {
            //     $this->orderItem->insert([
            //         'order_id' => $orderId,
            //         'product_variant_id' => $key,
            //         'quatity' => $item['ct_quantity'],
            //         'product_name' => $item['p_name'],
            //         'product_sku' => $item['p_sku'],
            //         'product_thumb_image' => $item['p_thumb_image'],
            //         'product_price_regular' => $item['p_price_regular'],
            //         'product_price_sale' => $item['p_price_sale'],
            //         'variant_color_name' => $item['pc_name'],
            //         'created_at' => date('Y-m-d H:i:s'),
            //         'updated_at' => date('Y-m-d H:i:s'),
            //     ]);
            // }

            ## @Code trước khi tối ưu

            /**
             * Sau khi mua hàng xong xóa session cart
             */

            unset($_SESSION['cart'], $_SESSION['data_checkout']);

            toastr('success', 'Cảm ơn bạn đã mua hàng');
            header('location: ' . routeClient('cart'));
            exit();
        }

        $cart = $this->cart->findByUserId($userId);
        // $data = $this->cartItem->selectInnerJoinProduct($cart['id']);

        // dd($data);

        // Nếu người dùng chưa có địa chỉ bắt nhập địa chỉ từ form lên
        // Nếu người dùng đã có địa chỉ thì truyền địa chỉ vào

        // dd($_SESSION);

        $connect = $this->order->getConnect();

        $this->order->insert([
            'user_id' => $userId,
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
        toastr('success', 'Cảm ơn bạn đã mua hàng');
        header('location: ' . routeClient('cart'));
        exit();
    }

    ## create order

    private function createOrder($userId, $data, $total)
    {
        $connect = $this->order->getConnect();

        $this->order->insert([
            'user_id' => $userId,
            'user_name' => $data['user_name'],
            'user_email' => $data['user_email'],
            'user_phone' => $data['user_phone'],
            'user_address' => $data['user_address'],
            'user_note' => $data['user_note'] ?? null,
            'total_price' => $total,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return $connect->lastInsertId();
    }

    private function createOrderItem($orderId, $data)
    {
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
    }
}
