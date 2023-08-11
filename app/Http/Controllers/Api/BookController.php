<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\User;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private BookService $bookService;

    /**
     * @param BookService $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return response()->json($this->bookService->index());
    }

    public function show(int $id)
    {
        $book = $this->bookService->show($id);
        if ($book){
            return response()->json($book);
        }
        return response()->json([], 404);
    }

    public function store(BookCreateRequest $request){
        return response()->json($this->bookService->store($request), 201);
    }

    public function update(int $id, BookUpdateRequest $request){
        return response()->json($this->bookService->update($id, $request), 200);
    }

}
