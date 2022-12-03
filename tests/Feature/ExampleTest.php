<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    use RefreshDatabase;
        /**
     * A basic test example.
     *
     * @return test
     */
    public function test_can_get_books()
    {   
        $books=Book::factory(4)->create();
        $response = $this->getJson(route('books.index'));
        $response->assertJsonFragment([
            'title' => $books[0]->title
        ])->assertJsonFragment([
            'title' => $books[1]->title
        ]);
    }

    public function test_can_get_one_book()
    {   
        $book=Book::factory()->create();
        $response = $this->getJson(route('books.show', $book));
        $response->assertJsonFragment([
            'title' => $book->title
        ]);
    }
}
