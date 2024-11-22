<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\Comment;

class CommentController extends Controller implements CRUDinterfaces
{

    private const PATH_VIEW = 'comments.';

    private Comment $comment;

    public function __construct()
    {
        parent::__construct();
        $this->comment = new Comment();
    }


    public function index()
    {

        $page = $_GET['page'] ?? 1;
        [$comments, $totalPage] = $this->comment->selectAllInnerJoin($page, 1);

        if ($page > $totalPage) {
            return header('location: ' . routeAdmin('comments'));
        }
        ;

        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'comments' => $comments,
            'totalPage' => $totalPage,
            'page' => $page
        ]);
    }
    public function create()
    {
    }
    public function store()
    {
    }
    public function show(string $id)
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function edit(string $id)
    {
    }
    public function update(string $id)
    {
    }
    public function delete(string $id)
    {
    }


}