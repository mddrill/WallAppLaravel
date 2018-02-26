<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use App\Http\Controllers\PostController;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Post;

class PostControllerTest extends BaseUnitTestCase
{

    public function testIndex()
    {
        $text_arr = [
                        "Once upon a midnight dreary, while I pondered weak and weary,",
                        "Over many a quaint and curious volume of forgotten lore, ",
                        "While I nodded, nearly napping, suddenly there came a tapping,",
                        "As of some one gently rapping, rapping at my chamber door.",
                        "'Tis some visitor,' I muttered, tapping at my chamber door -",
                        "Only this, and nothing more.'",
                        "Ah, distinctly I remember it was in the bleak December,",
                        "And each separate dying ember wrought its ghost upon the floor.",
                        "Eagerly I wished the morrow; - vainly I had sought to borrow",
                        "From my books surcease of sorrow - sorrow for the lost Lenore -"
                    ];
        $datetimes = [];
        $items = [];
        for ($i=0; $i<10; $i++) {
            $items[] = new Post([
                'id' => $i+1,
                'author_id' => $i + 3,
                'text' => $text_arr[$i],
                'created_at' => '2018-02-24 03:22:37',
                'updated_at' => '2018-02-24 03:22:37'
            ]);
        }
        $items = collect($items);
        $perPage = 10;
        $currentPage = 1;
        $total = count($items);
        $options = [
            'path' => 'http://localhost:8000/post',
            'pageName' => 'page'
        ];
        $posts = Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
        $mockPost = \Mockery::mock('App\Repositories\PostRepository');
        $mockPost->shouldReceive('paginate')
                   ->once()->with(10)
                   ->andReturn(collect($posts));

        $postController = new PostController($mockPost);
        $json = rtrim(file_get_contents(__DIR__ . '/../testjson/posts_list.json'));
        $this->assertEquals($json, json_encode($postController->index(), JSON_PRETTY_PRINT));
    }

    public function testShow()
    {
        $post = new Post([
            'id' => 5,
            'author_id' => 7,
            'text' => "'Tis some visitor,' I muttered, tapping at my chamber door -",
            'created_at' => '2018-02-24 03:22:37',
            'updated_at' => '2018-02-24 03:22:37'
        ]);

        $mockPost = \Mockery::mock('App\Repositories\PostRepository');
        $mockPost->shouldReceive('findOrFail')
                   ->once()->with(5)
                   ->andReturn($post);

        $postController = new PostController($mockPost);
        $json = rtrim(file_get_contents(__DIR__ . '/../testjson/post.json'));
        $this->assertEquals($json, json_encode($postController->show(5), JSON_PRETTY_PRINT));
        $this->assertHTTPExceptionStatus(400, function () use ($postController){
            $postController->show(NULL);
        });
    }

    public function testCreate()
    {
        $this->assertTrue(True);
    }

    public function testUpdate()
    {
        $this->assertTrue(True);
    }

    public function testDestroy()
    {
        $this->assertTrue(True);
    }
}
