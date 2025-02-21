<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class books extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_booksJson(): void
    {
        $response = $this->get('/booksJson');

        $response->assertStatus(200);
    }

    public function test_books(): void
    {
        $response = $this->get('/manageBooks');

        $response->assertStatus(200);
    }

    public function test_createBook(): void
    {
        $response = $this->post('/books/create', [
            'title' => 'Test Title',
            'author' => 'Test Author',
            'description' => 'Test Description',
            'price' => 'Test Price',
            'cover' => 'Test Cover',
            'isbn' => 'Test ISBN',
        ]);

        $response->assertStatus(302);
    }

    public function test_edit(): void
    {
        $response = $this->get('/books/edit/1');

        $response->assertStatus(200);
    }
}
