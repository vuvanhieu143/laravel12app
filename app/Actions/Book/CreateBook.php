<?php
namespace App\Actions\Book;

use App\Models\Book;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
class CreateBook
{
    public function __invoke(array $data, ?UploadedFile $cover = null): Book
    {
        if ($cover) {
            $data['cover'] = $cover->store('covers', 'public');
        }
        // Assign the authenticated user ID
        $data['user_id'] = Auth::id();

        return Book::create($data);
    }
}
