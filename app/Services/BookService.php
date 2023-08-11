<?php

namespace App\Services;

use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BookService
{

    private Book $book;

    /**
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index(): Collection{
        return $this->book->all();
    }

    public function show(int $id): Book{
        return $this->book->findOrFail($id);
    }

    public function store(BookCreateRequest $request): Book{
        return $this->book->create($request->all());
    }

    public function update(int $id, BookUpdateRequest $request): Book{
        $book = $this->show($id);
        $book->update($request->all());
        return $book;
    }


}
