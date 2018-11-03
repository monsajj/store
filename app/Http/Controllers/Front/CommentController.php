<?php

namespace App\Http\Controllers\Front;

use App\Shop\Comments\RequestRules\AddCommentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop\Comments\Comment;


class CommentController extends Controller
{
    /**
     * @var Comment
     */
    private $comment;

    /**
     * CommentController constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(AddCommentRequest $request)
    {
        $this->comment->product_id = $request->get('product_id');
        $this->comment->user_name = $request->get('user_name');
        $this->comment->email = $request->get('email');
        $this->comment->text = $request->get('text');
        $this->comment->save();
        return redirect()->route('product.show', ['product' => $request->get('product_slug')]);
    }
}
