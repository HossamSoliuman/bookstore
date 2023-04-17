<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponse;

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'number_of_stars' => 'required|integer|min:1|max:5',
            'book_id' => 'required|integer|exists:books,id',
            'review' => 'nullable|string',
        ]);
        
        $validatedData['user_id'] = $request->user()->id;

        $review = Review::create($validatedData);

        return $this->successResponse('Review created successfully', $review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        return $request;
        if($review->user_id != auth()->id())
        {
            return $this->errorResponse('unauthorized',null,501);
        }
        $validatedData = $request->validate([
            'number_of_stars' => 'nullable|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $review->update($validatedData);

        return $this->successResponse('Review updated successfully', $review);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        if($review->user_id != auth()->id())
        {
            return $this->errorResponse('unauthorized',null,501);
        }
        $review->delete();

        return $this->successResponse('Review deleted successfully');
    }
}