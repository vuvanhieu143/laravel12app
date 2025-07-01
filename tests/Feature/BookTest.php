<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BookTest extends TestCase {

    public function test_can_create_book_with_cover(): void {
        Storage::fake('public');
        $response = $this->post(route('books.store'), [
            'title' => 'Example Book',
            'author' => 'John Doe',
            'year' => 2024,
            'description' => 'Testing book',
            'cover' => UploadedFile::fake()->image('cover.jpg')
        ]);

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', ['title' => 'Example Book']);
        Storage::disk('public')->assertExists('covers/cover.jpg');
    }
}

