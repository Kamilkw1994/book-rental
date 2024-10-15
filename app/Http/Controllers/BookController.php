<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\BooksResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as Collection;
use App\Models\Client;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Collection
    {
        $query = Book::with(Book::RELATION_CLIENT);
    
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(Book::TITLE, 'like', "%{$search}%")
                  ->orWhere(Book::AUTHOR, 'like', "%{$search}%")
                  ->orWhereHas(Book::RELATION_CLIENT, function ($q) use ($search) {
                      $q->where(Client::FIRST_NAME, 'like', "%{$search}%")
                        ->orWhere(Client::LAST_NAME, 'like', "%{$search}%");
                  });
        }
        
        return BooksResource::collection($query->paginate(20));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): BookResource
    {
        $book = Book::with('client')
            ->findOrFail($id);
        
            return (new BookResource($book));
    }

    /**
     * Responsible for marking the book as rent
     */
    public function rent(Request $request, int $id): JsonResponse
    {
        $book = Book::findOrFail($id);
    
        if ($book->{Book::IS_RENTED}) 
        {
            return response()->json(['message' => 'Book is already rented'], 400);
        }
    
        $clientId = $request->input(Book::CLIENT_ID);
        $client = Client::findOrFail($clientId);

        
        $book->{Book::IS_RENTED} = true;
        $book->{Book::CLIENT_ID} = $clientId;
        $book->save();
    
        return response()->json(['message' => 'Book rented successfully', 'book' => new BookResource($book)], 200);
    }
    
    /**
     * Responsible for marking the book as return
     */
    public function return(int $id): JsonResponse
    {
        $book = Book::findOrFail($id);

        if ($book->is_rent === false) 
        {
            return response()->json(['message' => 'Book is not already rented'], 400);
        }

        $book->{Book::IS_RENTED} = false;
        $book->{Book::CLIENT_ID} = null;
        $book->save();
    
        return response()->json(['message' => 'Book return successfully', 'book' => new BookResource($book)], 200);
    }
    
}
