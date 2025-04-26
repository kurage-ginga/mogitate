@extends('layouts.app')

@section('title', '商品登録')

@section('content')
<div class="form-container">
    <h2 class="form__title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf

        <div class="form__group">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力">
            @error('name')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__group">
            <label for="price">価格</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
            @error('price')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__group">
            <label>季節</label>
            @foreach ($seasons as $season)
            <label class="checkbox-inline">
                <input type="checkbox" name="season[]" value="{{ $season->id }}"
                {{ is_array(old('season')) && in_array($season->id, old('season')) ? 'checked' : '' }}>
                {{ $season->name }}
            </label>
            @endforeach

            @error('season')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__group">
            <label for="description">説明</label>
            <textarea name="description" id="description" placeholder="説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__group">
            <label for="image">商品画像</label>
            <input type="file" name="image" id="image">
            @error('image')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">登録する</button>
        </div>
    </form>
</div>
@endsection