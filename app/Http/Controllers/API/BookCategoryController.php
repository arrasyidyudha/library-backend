<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $classification = $request->input('classification');
        $show_book = $request->input('show_book');

        if($id)
        {
            $category = BookCategory::with(['books'])->find($id);

            if($category)
                return ResponseFormatter::success(
                    $category,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data kategori produk tidak ada',
                    404
                );
        }

        $category = BookCategory::query();

        if($name)
            $category->where('name', 'like', '%' . $name . '%');
        if($classification)
            $category->where('classification', 'like', '%' . $classification . '%');
        if($show_book)
            $category->with('books');

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data list kategori produk berhasil diambil'
        );
    }
}
