<?php

namespace App\Repositories;

use App\Post;

class EloquentPostRepository implements PostRepository {

  public function all()
  {
    return Post::all();
  }

  public function find($id)
  {
    return Post::find($id);
  }

  public function findOrFail($id)
  {
      return Post::findOrFail($id);
  }

  public function create($input)
  {
    return Post::create($input);
  }

  public function paginate($count)
  {
      return Post::paginate($count);
  }

  public function make($array)
  {
      return Post::make($array);
  }

}
