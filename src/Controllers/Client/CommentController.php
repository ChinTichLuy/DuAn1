<?php

namespace App\Controllers\Client;

use App\Commons\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    private Comment $comment;

    public function __construct()
    {
        parent::__construct();
        $this->comment = new Comment();
        middleware_private_for_admin();
    }

    public function add()
    {

        $productId = $_POST['product_id'];
        $productSlug = $_POST['product_slug'];
        $userId = $_SESSION['user']['id'] ?? null;

        $validation = $this->validator->make($_POST, [
            'rating' => "required|min:1|max:5",
            'content' => "required"
        ]);

        $validation->validate();

        if ($validation->fails()) {
            toastr('error', 'Vui lòng nhập đầy đủ thông tin');
            header('location: ' . routeClient("shop/{$productSlug}/detail"));
            exit();
        } else {
            $this->comment->insert([
                'user_id' => $userId,
                'product_id' => $_POST['product_id'],
                'rating' => $_POST['rating'],
                'content' => $_POST['content'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            toastr('success', 'Cảm ơn bạn đã đánh giá sản phẩm');
            header('location: ' . routeClient("shop/{$productSlug}/detail"));
            exit();
        }
    }
}
