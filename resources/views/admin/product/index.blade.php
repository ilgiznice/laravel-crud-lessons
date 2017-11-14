@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            Товары

            @forelse($products as $product)
                <p>{{ $product->title }}</p>
                <p>{{ $product->price }}</p>
                <img src="{{ $product->image }}" alt="">
            @empty
                <p>Нет товаров</p>
            @endforelse
        </div>
    </div>
@stop