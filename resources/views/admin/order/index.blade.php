@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            Заказы

            <table class="table">
                <tr>
                    <th>ИД</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Адрес</th>
                    <th>Название товара</th>
                    <th>Сумма заказа</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </tr>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->product->title }}</td>
                        <td>{{ $order->product->price }}</td>
                        <td>{{ $order->status_title }}</td>
                        <td><a href="{{ route('order.edit', $order->id) }}">Редактировать</a></td>
                    </tr>
                @empty
                    <p>Нет заказов</p>
                @endforelse
            </table>
        </div>
    </div>
@stop