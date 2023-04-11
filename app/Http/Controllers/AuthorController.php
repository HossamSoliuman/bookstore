<?php
namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return $this->successResponse('', $authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'about' => 'required|string',
        ]);

        $author = Author::create([
            'name' => $validatedData['name'],
            'about' => $validatedData['about'],
        ]);

        return $this->successResponse('Author created successfully', $author);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $authorWithBooks = [
            'id' => $author->id,
            'name' => $author->name,
            'about' => $author->about,
            'books' => BookResource::collection($author->books),
        ];

        return $this->successResponse('', $authorWithBooks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'about' => 'sometimes|required|string',
        ]);

        $author->update([
            'name' => $validatedData['name'] ?? $author->name,
            'about' => $validatedData['about'] ?? $author->about,
        ]);

        return $this->successResponse('Author updated successfully', $author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return $this->successResponse('Author deleted successfully');
    }
}