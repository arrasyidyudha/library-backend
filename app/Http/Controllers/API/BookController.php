<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $code = $request->input('code');
        $title = $request->input('title');
        $description = $request->input('description');
        $author = $request->input('author');
        $publisher = $request->input('publisher');
        $city = $request->input('city');
        $isbn = $request->input('isbn');
        $year = $request->input('year');
        $quantity = $request->input('code');
        $categories = $request->input('categories');

        if($id)
        {
            $book = Book::with(['category','galleries'])->find($id);

            if($book)
                return ResponseFormatter::success(
                    $book,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );

        }

        $book = Book::with(['category','galleries']);

        if($code)
            $book->where('code', 'like', '%' . $code . '%');

        if($title)
            $book->where('title', 'like', '%' . $title . '%');
        
        if($description)
            $book->where('description', 'like', '%' . $description . '%');
    
        if($author)
            $book->where('author', 'like', '%' . $author . '%');

        if($publisher)
            $book->where('publisher', 'like', '%' . $publisher . '%');
    
        if($city)
            $book->where('city', 'like', '%' . $city . '%');

        if($isbn)
            $book->where('isbn', 'like', '%' . $isbn . '%');

        if($year)
            $book->where('year', 'like', '%' . $year . '%');

        if($quantity)
            $book->where('quantity', 'like', '%' . $quantity . '%');
    
        if($categories)
            $book->where('categories_id', $categories);

        return ResponseFormatter::success(
            $book->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
