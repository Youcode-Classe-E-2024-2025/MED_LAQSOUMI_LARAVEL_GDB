<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class booksTest extends TestCase
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
            'price' => 19.99, // Provide a numeric value for price
            'cover' => 'Test Cover',
            'isbn' => '1234567890123', // Provide a valid 13-character ISBN
        ]);

        $response->assertStatus(302);
    }
}
