<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:5|unique:articles,title',
            'description' => 'required',
            'image' => ''
        ];
    }

    public function messages()
    {
      return [
        'title.required' => 'Judul wajib diisi',
        'title.min' => 'Judul minimal 5 karakter',
        'title.unique' => 'Judul harus unik',
        'description.required' => 'Deskripsi wajib diisi'
      ];
    }




}
