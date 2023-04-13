<?php
namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Cart;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id; // Get the ID of the authenticated user
        $carts = Cart::where('user_id', $userId)->with('book')->get(); // Retrieve all cart items for the user and eager load the associated book
        $formattedCarts = $carts->map(function ($cart) {
            return [
                'id' => $cart->id,
                'quantity' => $cart->quantity,
                'book' => new BookResource($cart->book),
            ];
        }); // Format the book data in each cart item using the BookResource
        return $this->successResponse('', $formattedCarts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->user()->id;

        $validatedData = $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $cart = Cart::where('user_id', $user_id)
                    ->where('book_id', $validatedData['book_id'])
                    ->first();

        if ($cart) {
            // Update the quantity of an existing cart item
            $cart->increment('quantity', $validatedData['quantity'] ?? 1);
        } else {
            // Create a new cart item
            $cart = Cart::create([
                'book_id' => $validatedData['book_id'],
                'user_id' => $user_id,
                'quantity' => $validatedData['quantity'] ?? 1,
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return $this->successResponse('Cart item deleted successfully');
    }

    public function checkout(Request $request)
    {
        $userId = $request->user()->id;
        $carts = Cart::where('user_id', $userId)->with('book')->get();
        $total = 0;
    
        foreach ($carts as $cart) {
            $total += $cart->book->price * $cart->quantity;
        }
    
        $carts->each->delete();
    
        return $this->successResponse('Checkout successful', ['total' => $total]);
    }

}