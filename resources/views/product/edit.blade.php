@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          @if($errors->any())
              <div class="alert alert-danger">
                  <p><strong>Opps Something went wrong</strong></p>
                  <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                  </ul>
              </div>
          @endif

            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                  <form action="{{ url('/admin/product', $product->id) }}" method="post" enctype="multipart/form-data">
                      <!-- cross-site request forgery (csrf)-->
                      @csrf
                      <input type="hidden" name="_method" value="PUT">

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Title">Title</label>
                          <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Description">Description</label>
                          <textarea name="description" class="form-control" required> {{ $product->description }} </textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Qty">Qty</label>
                          <input type="number" name="qty" class="form-control" value="{{ $product->qty }}" required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Price">Price</label>
                          <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          @if($product->image != '')
                            <img src="{{ url('product/'.$product->image) }}" width="100">
                          @endif
                          <input type="file" name="image">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <button type="submit" class="btn btn-success"> Update </button>
                        </div>
                      </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
