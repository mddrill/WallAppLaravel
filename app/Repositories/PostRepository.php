<?php

namespace App\Repositories;

interface PostRepository {

  public function all();

  public function find($id);

  public function findOrFail($id);

  public function create($input);

  public function paginate($count);

  public function make($array);

}
