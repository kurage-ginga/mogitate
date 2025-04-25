@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="product-detail">
    <h2 class="product-detail__title">{{ $product->name }}</h2>

    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-detail__image">

    <p class="product-detail__price">価格: ¥{{ number_format($product->price) }}</p>

    <p class="product-detail__description">{{ $product->description }}</p>

    <p class="product-detail__seasons">
        対応季節：
        @foreach ($product->seasons as $season)
            <span>{{ $season->name }}</span>@if (!$loop->last), @endif
        @endforeach
    </p>
    <a href="{{ route('products.edit', $product->id) }}">編集する</a>
</div>
@endsection