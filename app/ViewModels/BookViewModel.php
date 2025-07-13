<?php
namespace App\ViewModels;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookViewModel extends ViewModel
{
    public function __construct(public ?string $search = null) {}

    public function books(): LengthAwarePaginator
    {
        return Book::where('user_id', Auth::id())
            ->tap(fn($q) =>
            $q->getQuery()->nestedWhere(
                'title', 'like', "%{$this->search}%",
                'or',
                'author', 'like', "%{$this->search}%"
            )
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function filters(): array {
        return ['search' => $this->search];
    }
}
