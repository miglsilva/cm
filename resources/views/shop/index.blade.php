@extends('layouts.master')

@section('title')
	Shop Cart
@endsection('title')
@section('content')
  @if(Session::has('sucess'))
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
      <div class"charge-message class="alert alert-sucess">
        {{ Session::get('sucess') }}
      </div>
    </div>
  </div>
  @endif
  @foreach( $products->chunk(3) as $productChunk )
        <div class="row">
          @foreach( $productChunk as $product)
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="{{ $product->imagepath }}" alt="...">
                <!-- url('/img/Layer-160-400x400.png') -->
                  <div class="caption"> 
                    <h3>{{ $product->title }}</h3>
                    <p>{{ $product->description }}</p>
                    <div class="clearfix"> 
                      <div class="pull-left price">${{ $product->price }}
                      </div>
                    <a href="{{ route('product.addtocart', ['id' => $product->id ]) }}" class="btn btn-default pull-right" role="button">Add to Cart</a>
                    </div>
                  </div>
               </div>
            </div>
          @endforeach()
        </div>
  @endforeach
@endsection('content')
