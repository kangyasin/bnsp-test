<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\NewArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

use File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Articles = Article::get();
        return view('article/list', compact('Articles'));
    }

    public function add_article()
    {
      return view('article/add');
    }

    public function edit_article($id)
    {
      $article = Article::find($id);
      return view('article/edit', compact('article', 'id'));
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
    public function store(NewArticleRequest $request)
    {
        $validated = $request->validated();
        $image = '';
        if($request->hasfile('image'))
        {
          $file = $request->file('image');
          $image = time() . $file->getClientOriginalName();
          $file->move(public_path() . '/article/', $image);
        }

        $validated['image'] = $image;
        $article = Article::create($validated);

        return redirect('admin/article')->with('success', 'article saved');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $validated = $request->validated();
        $article = Article::find($id);

        $image = '';
        if($request->hasfile('image'))
        {
          if($article->image != null || $article->image != ''){
            $pathImage = public_path() . '/article/' . $article->image;
            if(File::exists($pathImage)){
              File::delete($pathImage);
            }
          }
          $file = $request->file('image');
          $image = time() . $file->getClientOriginalName();
          $file->move(public_path() . '/article/', $image);
        }

        $validated['image'] = $image;
        $article->update($validated);

        return redirect('admin/article')->with('success', 'Data updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //select * from articles where id = $id;
      $article = Article::find($id);
      if($article->image != null || $article->image != ''){
        $pathImage = public_path() . '/article/' . $article->image;
// dd(File::exists($pathImage));
        if(File::exists($pathImage)){
          File::delete($pathImage);
        }
      }
      $article->delete();
      return redirect('admin/article')->with('success', 'Data deleted');
    }
}
