@extends('layouts.app')

@section('content')
    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> {{__('Заказы на бронирование')}}
            <a href="{{ route('reservation.create') }}" class="btn btn-success">{{__('Добавить новый заказ')}}</a></h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{__('Номер')}}</th>
                    <th>{{__('Название столика')}}</th>
                    <th>{{__('Количество гостей')}}</th>
                    <th>{{__('Дата и время')}}</th>
                    <th>{{__('Статус')}}</th>
                    <th>{{__('Действия')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td><a href="{{ route('reservation.show', $reservation->id) }}">#{{ $reservation->id }}</a></td>
                        <td>{{ $reservation->platen->title }}</td>
                        <td>{{ $reservation->countPersons }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->reservationStatus->title }}</td>
                        <td>
                            <p><a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Редактировать</a></p>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['reservation.destroy', $reservation->id] ]) !!}
                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection