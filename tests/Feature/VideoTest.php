<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testOnlyAuthenticatedUsersCanListVideos(): void
    {
        $request = $this->createIndexRequest();

        $response = $this->json(...$request);
        $response->assertStatus(401);


        $request['headers']['Authorization'] = $this->createAuthorizationToken();

        $response = $this->json(...$request);
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }


    public function testOnlyAuthenticatedUsersCanStoreVideos(): void
    {
        $request = $this->createStoreRequest();;

        $response = $this->json(...$request);
        $response->assertStatus(401);


        $request['headers']['Authorization'] = $this->createAuthorizationToken();

        $response = $this->json(...$request);
        $response->assertStatus(201);
    }

    private function createIndexRequest(): array
    {
        return [
            'method' => 'get',
            'uri' => route('videos.index'),
            'data' => [],
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];
    }

    private function createStoreRequest(): array
    {
        return [
            'method' => 'post',
            'uri' => route('videos.store'),
            'data' => [
                'title' => 'Introduction to Programming and Computer Science - Full Course',
                'description' => 'Instrodução a computação e programação',
                'url' => 'https://www.youtube.com/watch?v=zOjov-2OZ0E&ab_channel=freeCodeCamp.org',
            ],
            'headers' => [
                'Accept' => 'application/json',
            ]
        ];
    }

    private function createAuthorizationToken(): string
    {
        $user = User::factory()->create();
        $token = $user->createToken('token');

        return 'Bearer ' . $token->plainTextToken;
    }
}
