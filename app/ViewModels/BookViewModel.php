<?php
namespace App\ViewModels;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Facades\Auth;
class BookViewModel extends ViewModel
{
    public function __construct(public ?string $search = null) {}

    public function books(): LengthAwarePaginator
    {
        return Book::where('user_id', Auth::id())
            ->where(function ($query) {
                $search = $this->search;
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function filters(): array {
        return ['search' => $this->search];
    }
}
