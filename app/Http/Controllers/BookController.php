<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\http\Services\BookService;
use App\Models\Book;
use App\Traits\ApiResponse;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponse;
    use FileUpload;
    public function index()
    {
        $books = BookResource::collection(Book::all());
        return $this->successResponse('', $books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        return $request->all();
        $pathToImage = $this->upload($request->file('cover'), 'book_covers');
        $pathToBook = $this->upload($request->file('book'), 'books');

        $book = Book::create($request->all());
        $book->update([
            'cover_url' => str_replace('\\', '/', $pathToImage),
            'book_url' => str_replace('\\', '/', $pathToBook),
        ]);

        return $this->successResponse('successfully created', $book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $bookWithReviews = $book->load('reviews');
        return $this->successResponse('', BookResource::make($bookWithReviews));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

        $book->update($request->all());
        if ($request->hasFile('cover')) {
            $this->deleteFile($book->cover_url);
            $book->update([
                'cover_url' => $this->upload($request->file('cover'), 'book_covers'),
            ]);
        }

        if ($request->hasFile('book')) {

            $this->deleteFile($book->book_url);
            $book->update([
                'book_url' => $this->upload($request->file('book'), 'books'),
            ]);
        }

        return $this->successResponse('Successfully updated', BookResource::make($book));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->deleteFile($book->cover_url);
        $this->deleteFile($book->book_url);
        $book->delete();
        return $this->successResponse('Successfully deleted');
    }

    public function getBookReviewsRate(Book $book)
    {
        $bookWithReviews = $book->load('reviews');
        $rate = $bookWithReviews->reviews->avg('number_of_stars');
        return $rate;
    }
    public function bookOrders(Book $book, BookService $bookService)
    {
        $bookWithOrders = $bookService->bookOrders($book);
        return $this->successResponse('', $bookWithOrders);
    }
}
