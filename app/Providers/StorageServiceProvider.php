<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind(
      'App\Repositories\PostRepository',
      'App\Repositories\EloquentPostRepository'
    );
  }
}
