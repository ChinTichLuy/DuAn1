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

        return false;
    }
}
