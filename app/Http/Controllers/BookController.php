<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Actions\Book\CreateBook;
use App\Actions\Book\UpdateBook;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\ViewModels\BookViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller {
    public function index(Request $request): Response
    {

        return Inertia::render('Books/Index', new BookViewModel($request->search));
    }

    public function create(): Response
    {
        return Inertia::render('Books/Create');
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        Gate::authorize('book.create');
        $book = app(CreateBook::class)(
            $request->validated(),
            $request->file('cover')
        );
        $book->user_id = Auth::id();
        $book->save();

        return to_route('books.index')->with('success', 'Book created');
    }

    public function edit(Book $book): Response
    {
        return Inertia::render('Books/Edit', ['book' => $book]);
    }

    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        Gate::authorize('book.update', $book);
        app(UpdateBook::class)($book, $request->validated(), $request->file('cover'));

        return to_route('books.index')->with('success', 'Book updated');
    }

    public function destroy(Book $book): RedirectResponse
    {
        Gate::authorize('book.delete', $book);
        $book->delete();
        return to_route('books.index')->with('success', 'Book deleted');
    }
}
