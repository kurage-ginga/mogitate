@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="product-page">
    <!-- 左側：検索フォーム -->
    <aside class="product-sidebar">
        <form method="GET" action="{{ route('products.index') }}" class="search-form">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索">

        <button type="submit">検索</button>

            <select name="sort">
                <option value="">価格で並べ替え</option>
                <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>価格が高い順</option>
                <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>価格が安い順</option>
            </select>

        </form>

        @if(request('sort'))
            <div class="sort-tag">
                並び替え:
                {{ request('sort') === 'high' ? '価格が高い順' : '価格が安い順' }}
                <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}">x</a>
            </div>
        @endif
    </aside>

    <section class="product-list">
        <h2 class="product-list__title">商品一覧</h2>

        <div class="product-list__items">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-card__image">
                    <h3 class="product-card__name">{{ $product->name }}</h3>
                    <p class="product-card__price">¥{{ number_format($product->price) }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="product-card__link">詳細を見る</a>
                </div>
            @endforeach
        </div>
            {{ $products->links() }}
    </section>
</div>
@endsection