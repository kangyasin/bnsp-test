<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
       $id = $this->route()->parameter('id');
         return [
             'title' => 'required|string|min:5|unique:products,title,'.$id.'',
             'qty' => 'required|numeric',
             'price' => 'required|numeric',
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
         'qty.required' => 'Qty harus diisi',
         'qty.number' => 'Qty harus berupa angka',
         'price.required' => 'Harga harus diisi',
         'price.number' => 'Harga harus berupa angka',
         'description.required' => 'Deskripsi wajib diisi'
       ];
     }
}
