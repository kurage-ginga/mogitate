@extends('layouts.app')

@section('title', '商品編集')

@section('content')
<h2>商品を編集</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>商品名</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}">
    @error('name')<p>{{ $message }}</p>@enderror

    <label>価格</label>
    <input type="number" name="price" value="{{ old('price', $product->price) }}">
    @error('price')<p>{{ $message }}</p>@enderror

    <label>説明</label>
    <textarea name="description">{{ old('description', $product->description) }}</textarea>
    @error('description')<p>{{ $message }}</p>@enderror

    <label>季節</label>
    @foreach ($seasons as $season)
        <label>
            <input
                type="checkbox"
                name="season[]"
                value="{{ $season->id }}"
                {{ in_array($season->id, old('season', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
            {{ $season->name }}
        </label>
    @endforeach
    @error('season')<p>{{ $message }}</p>@enderror

    <label>画像</label>
    <input type="file" name="image">
    @error('image')<p>{{ $message }}</p>@enderror

    <button type="submit">更新する</button>
</form>
@endsection