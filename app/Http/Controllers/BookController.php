<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Book::with('category');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                     <div class="flex items-stretchspace-x-2 hover:space-x-8">
                     
                     <a class="inline-block border border-green-500 bg-green-500 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline" 
                     href="' . route('dashboard.book.gallery.index', $item->id) . '">
                     Gallery
                     </a>
                     <a class="inline-block border border-gray-500 bg-gray-500 text-white rounded-md px-2 py-1 m-1  transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                     href="' . route('dashboard.book.edit', $item->id) . '">
                     Edit
                     </a>
                     <form class="inline-block" action="' . route('dashboard.book.destroy', $item->id) . '" method="POST">
                     <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                     Hapus
                    </button>
                     ' . method_field('delete') . csrf_field() . '
                    </form>
                    </div>';
                })
               
                ->rawColumns(['action'])
                ->make();
        }
   
     return view('pages.dashboard.book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BookCategory::all();
        return view('pages.dashboard.book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Book::create($data);

        return redirect()->route('dashboard.book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = BookCategory::all();
        return view('pages.dashboard.book.edit',[
            'item' => $book,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book $book)
    {
        $data = $request->all();

        $book->update($data);

        return redirect()->route('dashboard.book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('dashboard.book.index');
    }

   
}
