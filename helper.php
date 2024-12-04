<?php

// các function hỗ trợ 
if (!function_exists('dd')) {
    function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die;
    }
}


if (!function_exists('routeAdmin')) {
    function routeAdmin($url = null)
    {
        return $_ENV['BASE_URL_ADMIN'] . $url;
    }
}


if (!function_exists('routeClient')) {
    function routeClient($url = null)
    {
        return $_ENV['BASE_URL'] . $url;
    }
}

if (!function_exists('asset')) {
    function asset($path = null)
    {
        return $_ENV['ASSETS'] . $path;
    }
}

if (!function_exists('slug')) {
    function slug($string)
    {
        // Chuyển đổi tiếng Việt có dấu thành không dấu
        $string = removeVietnameseAccents($string);

        // Chuyển tất cả các ký tự thành chữ thường
        $string = strtolower($string);

        // Loại bỏ các ký tự đặc biệt, chỉ giữ lại chữ cái và số
        $string = preg_replace('/[^a-z0-9\s]/', '', $string);

        // Thay thế nhiều khoảng trắng liên tiếp thành một dấu gạch ngang
        $string = preg_replace('/\s+/', '-', $string);

        // Loại bỏ dấu gạch ngang ở đầu và cuối chuỗi
        $string = trim($string, '-');


        $uniqueHash = substr(md5(uniqid()), 0, 10);

        return $string . '-' . $uniqueHash;
    }
}

if (!function_exists('removeVietnameseAccents')) {
    function removeVietnameseAccents($string)
    {
        $accents = [
            'a' => ['à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ'],
            'e' => ['è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ'],
            'i' => ['ì', 'í', 'ị', 'ỉ', 'ĩ'],
            'o' => ['ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ'],
            'u' => ['ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ'],
            'y' => ['ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ'],
            'd' => ['đ'],
            'A' => ['À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ'],
            'E' => ['È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ'],
            'I' => ['Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ'],
            'O' => ['Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ'],
            'U' => ['Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ'],
            'Y' => ['Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ'],
            'D' => ['Đ']
        ];

        foreach ($accents as $nonAccent => $accentGroup) {
            $string = str_replace($accentGroup, $nonAccent, $string);
        }

        return $string;
    }
}


if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return number_format($price);
    }
}

## hiển thị lỗi
if (!function_exists('error')) {
    function error($field)
    {
        // if (!empty($_SESSION['errors']) && !empty($_SESSION['errors'][$field])) {
        //     return $_SESSION['errors'][$field];
        // }


        if (!empty($_SESSION['errors'])) {
            // Chuyển `product[name]` thành `product.name` để duyệt chính xác
            $keys = explode('.', str_replace(['[', ']'], ['.', ''], $field));

            // Bắt đầu từ mảng lỗi gốc
            $current = $_SESSION['errors'];
            foreach ($keys as $key) {
                if (!isset($current[$key])) {
                    return null; // Không tìm thấy lỗi
                }
                $current = $current[$key];
            }
            return $current; // Trả về lỗi cuối cùng
        }
        return null;
    }
}

## lấy data đã nhập ở input ra
if (!function_exists('getOldValue')) {
    function getOldValue($field)
    {
        if (!empty($_SESSION['old-data']) && !empty($_SESSION['old-data'][$field])) {
            return $_SESSION['old-data'][$field];
        }
    }
}

##
if (!function_exists('unsetSession')) {
    function unsetSession()
    {
        unset($_SESSION['errors']);
        unset($_SESSION['old-data']);
        unset($_SESSION['toastr']);
    }
}


if (!function_exists('toastr')) {
    function toastr($icon = 'success', $message = '', $title = '')
    {
        $_SESSION['toastr'] = [
            'icon' => $icon,
            'message' => $message,
            'title' => $title
        ];
    }
}

if (!function_exists('upload_file')) {
    function upload_file($file, $path = null)
    {
        $pathBase = $_ENV['PATH_UPLOAD'];

        if ($path) {
            // 
            $pathBase .= trim($path, '/') . '/';

            //
            if (!file_exists($pathBase)) {
                mkdir($pathBase, 0777, true);
            }
        }

        if (is_array($file)) {
            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
        } else {
            return false;
        }

        $hasFile = pathinfo($fileName, PATHINFO_EXTENSION);

        $fileName = uniqid() . '-' . time() . '.' . $hasFile;
        // $uploadPath = $pathBase . time() . '-' . basename($file['name']);

        $uploadPath = $pathBase . $fileName;


        if (move_uploaded_file($fileTmp, $uploadPath)) {
            return $uploadPath;
        }

        return false;
    }
}


// if (!function_exists('upload_file')) {
//     function upload_file($file)
//     {
//         $imagePath = $_ENV['PATH_UPLOAD'] . uniqid() . '-' . basename($file['name']);

//         if (move_uploaded_file($file['tmp_name'], $imagePath)) {
//             return $imagePath;
//         }

//         return null;
//     }
// }

if (!function_exists('getImage')) {
    function getImage($file)
    {
        return $_ENV['BASE_URL'] . $file;
    }
}

if (!function_exists('delete_image')) {
    function delete_image($file)
    {
        if (!empty($file) && file_exists($file)) {
            unlink($file);
        }
    }
}

if (!function_exists('limitText')) {
    function limitText($text, $length = 10)
    {
        return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
    }
}

if (!function_exists('calculateTotalProduct')) {
    function calculateTotalProduct($data)
    {
        return array_reduce($data, function ($total, $item) {
            return $total + ($item['p_price_sale'] ?: $item['p_price_regular']) * $item['ct_quantity'];
        }, 0);
    }
}

if (!function_exists('calculateSubTotal')) {
    function calculateSubTotal($price, $quantity)
    {
        return formatPrice($price * $quantity) . 'đ';
    }
}

// handle momo

if (!function_exists('execPostRequest')) {
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}

if (!function_exists('momo')) {
    function momo($price)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $price;
        $orderId = rand(00, 9999);
        $redirectUrl = $_ENV['BASE_URL'] . 'checkout/momo';
        $ipnUrl = $_ENV['BASE_URL'] . 'checkout/momo';
        $extraData = "";

        // $partnerCode = $partnerCode;
        // $accessKey = $accessKey;
        // $serectkey = $secretKey;
        // $orderId = $orderId; // Mã đơn hàng
        // $orderInfo = $orderInfo;
        // $amount = $amount;
        // $ipnUrl = $ipnUrl;
        // $redirectUrl = $redirectUrl;
        // $extraData = $extraData;

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there
        // setcookie("title_confirm", "Đặt hàng thành công", time() + 1);
        // setcookie("subTitle_confirm", "Đã gửi mail xác nhận đơn hàng", time() + 1);
        header('Location: ' . $jsonResult['payUrl']);
    }
}

if (!function_exists('middleware_private_route')) {
    function middleware_private_route()
    {
        isset($_SESSION['user']) ? header('location: ' . routeClient()) && exit() : null;
    }
}

## function helper tạo mã order_code unique

if (!function_exists('generateOrderCode')) {
    function generateOrderCode($prefix = 'nhom1_', $length = 10)
    {
        $time = time();
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
        return $prefix . $time . $randomString;
    }
}

// Tính rating
if (!function_exists('calRating')) {
    function calRating($rating)
    {
        return match ($rating) {
            5 => '100%',
            4 => '80%',
            3 => '60%',
            2 => '40%',
            1 => '20%',
            0 => '0%'
        };
    }
}

// 
if (!function_exists('middleware_auth')) {
    function middleware_auth()
    {
        if (!$_SESSION['user'] || $_SESSION['user']['role'] != 1) {
            header('location: ' . routeClient());
            exit();
        }
    }
}

if (!function_exists('middleware_isAuth')) {
    function middleware_isAuth()
    {
        if (!$_SESSION['user']) {
            header('location: ' . routeClient());
            exit();
        }
    }
}
// function match class và trạng thái đơn hàng / thanh toán
if (!function_exists('matchStatusOrderClass')) {
    function matchStatusOrderClass($status)
    {
        return match ($status) {
            'pending' => 'bg-warning text-white',
            'confirmed' => 'bg-primary text-white',
            'preparing_goods' => 'bg-info text-white',
            'shipping' => 'bg-secondary text-white',
            'delivered' => 'bg-success text-white',
            'canceled' => 'bg-danger text-white',
        };
    }
}

if (!function_exists('matchStatusOrder')) {
    function matchStatusOrder($status)
    {
        return match ($status) {
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'preparing_goods' => 'Đang chuẩn bị hàng',
            'shipping' => 'Đang vận chuyển',
            'delivered' => 'Đã giao hàng',
            'canceled' => 'Đơn hàng đã bị hủy',
        };
    }
}

if (!function_exists('matchStatusPayMent')) {
    function matchStatusPayMent($status)
    {
        return match ($status) {
            'unpaid' => "Chưa thanh toán",
            'paid' => "Đã thanh toán"
        };
    }
}
