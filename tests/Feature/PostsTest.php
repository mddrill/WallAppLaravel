<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;
use App\User;

class PostsTest extends BaseTestCase
{
    public function testAnyoneCanGetPost()
    {
        $post_id = 7;
        $response = $this->get('/post');
        $this->assertStatusCode(200, $response);
        $response = $this->get('/post/1');
        $this->assertStatusCode(200, $response);
    }

    public function testOnlyLoggedInUserCanCreatePost()
    {
        $post_id = 7;
        $text = 'Mary had a little lamb';
        $payload = ['text' => $text];
        $response = $this->json('POST', '/post', $payload);
        $this->assertStatusCode(401, $response);

        $id = 2;
        Passport::actingAs(User::findOrFail($id));
        $response = $this->json('POST', '/post', $payload);
        $this->assertStatusCode(201, $response);
        $this->assertDatabaseHas('posts', [
            'author_id' => $id,
            'text' => $text,
        ]);
    }

    public function testOnlyPostAuthorCanUpdatePost()
    {
        $post_id = 7;
        $text = 'Mary had a little lamb';
        $payload = ['text' => $text];
        $response = $this->json('PUT', "/post/$post_id", $payload);
        $this->assertStatusCode(401, $response);

        $wrong_user_id = ($post_id)%3+1;
        Passport::actingAs(User::findOrFail($wrong_user_id));
        $response = $this->json('PUT', "/post/$post_id", $payload);
        $this->assertStatusCode(403, $response);

        $correct_user_id = ($post_id+1)%3+1;
        Passport::actingAs(User::findOrFail($correct_user_id));
        $response = $this->json('PUT', "/post/$post_id", $payload);
        $this->assertStatusCode(200, $response);
        $this->assertDatabaseHas('posts', [
            'text' => $text,
            'author_id' => $correct_user_id
        ]);
    }

    public function testOnlyPostAuthorCanDeletePost()
    {
        $post_id = 7;
        $response = $this->json('DELETE', "/post/$post_id");
        $this->assertStatusCode(401, $response);

        $wrong_user_id = ($post_id)%3+1;
        Passport::actingAs(User::findOrFail($wrong_user_id));
        $response = $this->json('DELETE', "/post/$post_id");
        $this->assertStatusCode(403, $response);

        $correct_user_id = ($post_id+1)%3+1;
        Passport::actingAs(User::findOrFail($correct_user_id));
        $response = $this->json('DELETE', "/post/$post_id");
        $this->assertStatusCode(204, $response);
        $this->assertDatabaseMissing('posts', ['id' => $post_id]);
    }
}
