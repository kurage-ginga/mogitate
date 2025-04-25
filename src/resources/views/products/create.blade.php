@extends('layouts.app')

@section('title', '商品登録')

@section('content')
<div class="form">
    <h2 class="form__title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="form__body">
        @csrf

        <div class="form__group">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__group">
            <label for="price">価格</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}">
            @error('price')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__group">
            <label for="image">画像</label>
            <input type="file" name="image" id="image">
            @error('image')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__group">
            <label>季節</label>
            @foreach ($seasons as $season)
            <label>
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
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="form__submit">登録する</button>
    </form>
</div>
@endsection