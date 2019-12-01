<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\UpdateProductRequest;
use File;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

      $Products = Product::get();
      return view('product/list', compact('Products'));
  }

  public function add_product()
  {
    return view('product/add');
  }

  public function edit_product($id)
  {
    $product = Product::find($id);
    return view('product/edit', compact('product', 'id'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(NewProductRequest $request)
  {
      $validated = $request->validated();
      $image = '';
      if($request->hasfile('image'))
      {
        $file = $request->file('image');
        $image = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/product/', $image);
      }

      $validated['image'] = $image;
      $product = Product::create($validated);

      return redirect('admin/product')->with('success', 'product saved');
  }
  /**
   * Display the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateProductRequest $request, $id)
  {
      $validated = $request->validated();
      $product = Product::find($id);

      $image = '';
      if($request->hasfile('image'))
      {
        if($product->image != null || $product->image != ''){
          $pathImage = public_path() . '/product/' . $product->image;
          if(File::exists($pathImage)){
            File::delete($pathImage);
          }
        }
        $file = $request->file('image');
        $image = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/product/', $image);
      }

      $validated['image'] = $image;
      $product->update($validated);

      return redirect('admin/product')->with('success', 'Data updated');

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //select * from products where id = $id;
    $product = Product::find($id);
    if($product->image != null || $product->image != ''){
      $pathImage = public_path() . '/product/' . $product->image;
// dd(File::exists($pathImage));
      if(File::exists($pathImage)){
        File::delete($pathImage);
      }
    }
    $product->delete();
    return redirect('admin/product')->with('success', 'Data deleted');
  }
}
