@extends('layouts.app')

@section('content')
    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> {{__('Заказы на бронирование')}}
            <a href="{{ route('reservation.create') }}" class="btn btn-success">{{__('Добавить новый заказ')}}</a></h1>

            <form method="GET" action="{{ route('reservation.index') }}">
                {{ csrf_field() }}
                <select name="filter-key">
                    @foreach($statusOptions as $key => $value)
                        <option {{ $currentKey === $key ? 'selected' : '' }}  value="{{ $key }}">{{__($value)}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">
                    {{ __('Показать') }}
                </button>

            </form>
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
                <?php /** @var \App\Http\Models\Reservation\Reservation $reservation */  ?>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->platen->title }}</td>
                        <td>{{ $reservation->count_persons }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->reservationStatus->title }}</td>
                        <td>
                            <div class="row">
                                <a href="{{ route('reservation.show', $reservation->id) }}"
                                   class="btn btn-success pull-left">Посмотреть детали</a>
                            </div>
                            <div class="row">
                                <a href="{{ route('reservation.edit', $reservation->id) }}"
                                   class="btn btn-info pull-left">Редактировать</a>
                            </div>
                            <div class="row">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['reservation.destroy', $reservation->id] ]) !!}
                                {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$reservations->appends(['filter-key' => $currentKey])->links()}}
    </div>
@endsection