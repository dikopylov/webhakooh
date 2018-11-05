@extends('layouts.app')

@section('content')
    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> {{__('Заказы на бронирование')}}
            <a href="{{ route('reservation.create') }}" class="btn btn-success">{{__('Добавить новый заказ')}}</a></h1>

            <form method="POST" action="{{ route('reservation.filter') }}">
                {{ csrf_field() }}
                <select name="filterKey">
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
                            <p>
                                <a href="{{ route('reservation.show', $reservation->id) }}"
                                   class="btn btn-success pull-left" style="margin-right: 3px;">Посмотреть детали</a>
                            </p>
                            <p>
                                <a href="{{ route('reservation.edit', $reservation->id) }}"
                                   class="btn btn-info pull-left" style="margin-right: 3px;">Редактировать</a>
                            </p>

                            <p><a href="javascript:void(0);"
                                  onclick="deleteItem({{ $reservation->id . ', \'' . route('reservation.destroy', [$reservation->id]) . '\''}})"
                                  class="btn btn-danger" style="margin-right: 3px;">Удалить</a></p>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection