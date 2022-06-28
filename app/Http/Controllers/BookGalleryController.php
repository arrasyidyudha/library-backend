<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookGalleryRequest;
use App\Models\Book;
use App\Models\BookGallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        if (request()->ajax()) {
            $query = BookGallery::where('id_books', $book->id);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                       <div class="flex">
                       <form class="inline-block" action="' . route('dashboard.gallery.destroy', $item->id) . '" method="POST">
                       <button class="border pl-8 border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                           Hapus
                       </button>
                           ' . method_field('delete') . csrf_field() . '
                       </form>
                       </div>';
                })
                ->editColumn('url', function ($item) {
                    return '<img style="max-width: 150px;" src="'. $item->url .'"/>';
                })
                ->editColumn('is_featured', function ($item) {
                    return $item->is_featured ? 'Yes' : 'No';
                })
                ->rawColumns(['action', 'url'])
                ->make();
        }

        return view('pages.dashboard.gallery.index', compact('book'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('pages.dashboard.gallery.create', compact('book'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookGalleryRequest $request, Book $book )
    {
        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {
                $path = $file->store('public/gallery');

                BookGallery::create([
                    'id_books' => $book->id,
                    'url' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.book.gallery.index', $book->id);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookGallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(BookGallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookGallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(BookGallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookGallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookGallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookGallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookGallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('dashboard.book.gallery.index', $gallery->id_books);
 
    }
}
