<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\PostRepository as Post;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(Post $post)
    {
      $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->paginate(10);
        return response()->json($posts, 200);
    }

    public function show($id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $post = $this->post->findOrFail($id);
        return response()->json($post, 200);
    }

    public function create(Request $request)
    {
        $post = $this->post->make([
            'author_id' => $request->user()->id,
            'text' => $request->input('text')
        ]);
        if ($post->save()) {
            return response()->json($post, 201);;
        } else {
            throw new HttpException(400, "Invalid data");
        }
    }

    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        if ($request->user()->id != $this->post->find($id)->author_id) {
            throw new HttpException(403, "Unauthorized user");
        }
        $post = $this->post->findOrFail($id);
        $post->author_id = $request->user()->id;
        $post->text = $request->input('text');
        if ($post->save()) {
            return response()->json($post, 200);;
        } else {
            throw new HttpException(400, "Invalid data");
        }
    }

    public function destroy($id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        if (Auth::user()->id != $this->post->find($id)->author_id) {
            throw new HttpException(403, "Unauthorized user");
        }
        $post = $this->post->findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'post deleted'], 204);
    }
}
