@extends('layouts.front.app')

@section('og')
    <meta property="og:type" content="product"/>
    <meta property="og:title" content="{{ $product->name }}"/>
    <meta property="og:description" content="{{ strip_tags($product->description) }}"/>

    @if ($product->images->count() > 0)
        @foreach($product->images as $image)
            <meta property="og:image" content="{{ asset("storage/$image->src") }}"/>
        @endforeach
    @endif
@endsection

@section('content')
    <div class="container product">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"> <i class="fa fa-home"></i> Home</a></li>
                    @if(isset($category))
                    <li><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></li>
                    @endif
                    <li class="active">Product</li>
                </ol>
            </div>
        </div>
        @include('layouts.front.product')
    </div>
@endsection
