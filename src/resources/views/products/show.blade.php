@extends('layouts.app')

@section('title', '商品詳細・編集')

@section('content')
<div class="form-container">
    <h2 class="form-title">商品詳細・編集</h2>

    <div class="product-detail__image-wrapper">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-detail__image">
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf
        @method('PUT')
        <input type="file" name="image" id="image">
        @error('image')<p class="form-error">{{ $message }}</p>@enderror

        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">価格</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>季節</label>
            @foreach ($seasons as $season)
                <label class="checkbox-inline">
                    <input type="checkbox" name="season[]" value="{{ $season->id }}"
                        {{ (is_array(old('season', $product->seasons->pluck('id')->toArray())) && in_array($season->id, old('season', $product->seasons->pluck('id')->toArray()))) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
            @endforeach
            @error('season')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">商品説明</label>
            <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">更新する</button>
        </div>
    </form>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">🗑️</button>
    </form>
</div>
@endsection