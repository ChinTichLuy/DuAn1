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


if (!function_exists('routeAdmin')) {
    function routeAdmin($url = null)
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
        if (!empty($_SESSION['errors']) && !empty($_SESSION['errors'][$field])) {
            return $_SESSION['errors'][$field];
        }
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
