@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            Импорт из CSV (разделитель ;)

            <form action="{{ route('product.import.csv') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="file">
                <button type="submit">Импортировать файл</button>
            </form>
        </div>
    </div>
@stop