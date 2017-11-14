@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            Создать товар

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                Название <input type="text" name="title"> <br>
                Описание <input type="text" name="description"><br>
                Цена <input type="text" name="price"><br>
                Изображение <input type="file" name="image">
                <button type="submit">Создать</button><br>
            </form>
        </div>
    </div>
@stop