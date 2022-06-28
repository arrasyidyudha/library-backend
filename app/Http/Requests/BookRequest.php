<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
            'code' => 'required',
             'title' => 'required', 
             'description' => 'required', 
             'author' => 'required', 
             'publisher' => 'required', 
             'city' => 'required', 
             'isbn' => 'required', 
             'year' => 'required', 
             'quantity' => 'required', 
             'id_categories' => 'required'
                
        ];
    }
}
