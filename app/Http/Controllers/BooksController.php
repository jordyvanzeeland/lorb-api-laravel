<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Require authentication for all methods in this controller.
     */

    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Retrieve all reading years.
     */

    public function getReadingYears() {
        $readingYears = Book::selectRaw('YEAR(readed) as year, COUNT(YEAR(readed)) as yearCount')->groupByRaw('YEAR(readed)')->get();
        return response()->json($readingYears, 200);
    }

    /**
     * Retrieve all books.
     */

    public function getAllBooks(){
        $booksList = Book::get();
        return response()->json($booksList, 200);
    }

    /**
     * Retrieve all books by year.
     */

     public function getBooksByYear(string $year){
        $booksList = Book::whereYear('readed', $year)->get();
        return response()->json($booksList, 200);
    }

    /**
    * Retrieve a single book by it's id.
    * If book is not found, then it wil give a 404 response
    */

    public function getBook(int $bookid){
        $book = Book::find($bookid);

        if(!$book){
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book, 200);
    }

    /**
    * Insert a new book
    */

    public function insertBook(Request $request){
        $newBook = Book::create($request->all());
        return response()->json(['message' => 'New book added', 'project' => $newBook], 201);
    }
    
    /**
    * Update an existing book by it's id.
    * If book is not found, then it wil give a 404 response
    */

    public function updateBook(Request $request, int $bookid){
        $book = Book::find($bookid);
        
        if(!$book){
            return response()->json(['message' => 'Book not found'], 404);
        }
        
        $book->update($request->all());
        return response()->json(['message' => 'Book updated', 'book' => $book], 200);
    }

    /**
    * Delete an existing book by it's id.
    * If book is not found, then it wil give a 404 response
    */

    public function deleteBook(int $bookid){
        $book = Book::find($bookid);

        if(!$book){
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted'], 200);
    }
}
?>