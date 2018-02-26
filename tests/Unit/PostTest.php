<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class PostTest extends BaseUnitTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPost()
    {
        $author_id = 2;
        $text = 'yiggidy yiggy';
        $post = new Post([
            'author_id' => $author_id,
            'text' => $text
        ]);
        $this->assertTrue($post instanceof Post);
        $this->assertTrue($post->author_id === $author_id);
        $this->assertTrue($post->text === $text);
    }
}
