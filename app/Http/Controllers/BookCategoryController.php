<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCategoryRequest;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = BookCategory::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <div class="flex items-stretch">
                        <a class="inline-block border-green-500 bg-green-500 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('dashboard.category.edit', $item->id) . '">
                            Edit
                        </a>
                        <br>
                        <form class="inline-block" action="' . route('dashboard.category.destroy', $item->id) . '" method="POST">
                        <div> 
                        </div>
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
   
     return view('pages.dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = BookCategory::all();
        return view('pages.dashboard.category.create', compact('categories'));
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCategoryRequest $request)
    {
        $data = $request->all();

        BookCategory::create($data);

        return redirect()->route('dashboard.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(BookCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(BookCategory $category)
    {
        return view('pages.dashboard.category.edit',[
            'item' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(BookCategoryRequest $request, BookCategory $category)
    {
       
        $data = $request->all();

        $category->update($data);
        return redirect()->route('dashboard.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookCategory $category)
    {
        $category->delete();
        return redirect()->route('dashboard.category.index');
    }
}
