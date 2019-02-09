@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
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
        @if (isset($message))
            <div class="alert alert-success col-3 text-center alert-dismissible platen-alert-block" role="alert">
                <button type="button" class="close platen-close-alert-button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{$message}}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{__('Номер')}}</th>
                    <th>{{__('Название столика')}}</th>
                    <th>{{__('Имя клиента')}}</th>
                    <th>{{__('Количество гостей')}}</th>
                    <th>{{__('Дата и время')}}</th>
                    <th>{{__('Статус')}}</th>
                    <th>{{__('Действия')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var \App\Http\Models\Reservation\Reservation $reservation */  ?>
                @foreach ($reservations as $reservation)
                    <tr id="{{ $reservation->id }}">
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->platen->title }}</td>
                        <td>{{ $reservation->client->name }}</td>
                        <td>{{ $reservation->count_persons }}</td>
                        <td>{{ $reservation->date }} {{$reservation->time}}</td>
                        <td>{{ $reservation->reservationStatus->title }}</td>
                        <td>
                            <div class="row">
                                <a href="{{ route('reservation.show', $reservation->id) }}"
                                   class="btn btn-success pull-left">Посмотреть детали</a>
                            </div>
                            <div class="row">
                                <a href="{{ route('reservation.edit', $reservation->id) }}"
                                   class="btn btn-info pull-left" style="margin-right: 3px;">Редактировать</a>
                            </div>
                            <div class="row">
                                <a href="javascript:void(0);"
                                   onclick="deleteItem({{ $reservation->id. ', \'' . route('reservation.destroy', [$reservation->id]) . '\''}})"
                                   class="btn btn-danger" style="margin-right: 3px;">Удалить</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$reservations->appends(['filter-key' => $currentKey])->links()}}
    </div>
    @if (isset($alert))
        <script type="text/javascript">
            alert('{{$alert}}');
        </script>
    @endif
@endsection