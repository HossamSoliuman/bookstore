<?php
namespace App\http\Services ;

use App\Models\Book;

class BookService {

    public function bookOrders(Book $book)
    {
        $orders = $book->orders()->with('user')->get();
    
        $bookWithOrders = [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'orders' => $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'quantity' => $order->quantity,
                    'user' => $order->user->name,
                ];
            }),
        ];
    
        return $bookWithOrders;
    }
}
