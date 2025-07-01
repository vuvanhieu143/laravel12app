<?php
// app/Actions/Book/UpdateBook.php
namespace App\Actions\Book;

use App\Models\Book;
use Illuminate\Http\UploadedFile;

class UpdateBook
{
    public function __invoke(Book $book, array $data, ?UploadedFile $cover = null): Book
    {
        if ($cover) {
            $data['cover'] = $cover->store('covers', 'public');
        }
        $book->update($data);

        return $book;
    }
}
