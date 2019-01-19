@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Редактирование заказа на бронь')}}
                        <div class="card-body">
                            <form method="POST" action="{{ URL::route('reservation.update', $reservation->id) }}">
                                {{ method_field('PUT') }}
                                @csrf
                                <div class="form-group row">
                                    <label for="platen-id" class="col-md-4 col-form-label text-md-right">{{ __('Столик') }}</label>
                                    <div class="col-md-6">
                                        <select id="platen-id" onchange="loadTimeSelect($(this).val(), $('#visit-date').val(), '{{route('reservation.get-free-times')}}', '{{$reservation->id}}')" class="form-control reservations-edit-select" name="platen-id">
                                            @foreach($platens as $platen)
                                                @if ($platen->id === $reservation->platen->id)
                                                    <option value="{{$platen->id}}" selected>{{$platen->title}}</option>
                                                @else
                                                    <option value="{{$platen->id}}">{{$platen->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="visit-date" class="col-md-4 col-form-label text-md-right">{{ __('Дата и время посещения') }}</label>
                                    <div class="col-md-3">
                                        <input id="visit-date" onchange="loadTimeSelect($('#platen-id').val(), $(this).val(), '{{route('reservation.get-free-times')}}', '{{$reservation->id}}')" type="date" class="form-control{{ $errors->has('visit-date') ? ' is-invalid' : '' }}" name="visit-date"  value="{{ $reservation->date }}" required autofocus>
                                        @if ($errors->has('visit-date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('visit-date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <select name="visit-time" id="visit-time" class="form-control reservations-edit-select">
                                            @foreach($times as $time)
                                                @if (\Carbon\Carbon::parse($time) == \Carbon\Carbon::parse($reservation->time))
                                                    <option value="{{$time}}" selected>{{$time}}</option>
                                                @else
                                                    <option value="{{$time}}">{{$time}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="persons-count" class="col-md-4 col-form-label text-md-right">{{ __('Количество гостей') }}</label>
                                    <div class="col-md-6">
                                        <input id="persons-count" type="number" min="1" class="form-control{{ $errors->has('persons-count') ? ' is-invalid' : '' }}" name="persons-count" value="{{ $reservation->count_persons }}" required>
                                        @if ($errors->has('persons-count'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('persons-count') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="client-name" class="col-md-4 col-form-label text-md-right">{{ __('Имя клиента') }}</label>
                                    <div class="col-md-6">
                                        <input id="client-namet" type="text" min="1" class="form-control{{ $errors->has('client-name') ? ' is-invalid' : '' }}" name="client-name" value="{{ $reservation->client->name }}" required>
                                        @if ($errors->has('client-name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('client-name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="client-phone" class="col-md-4 col-form-label text-md-right">{{ __('Телефон клиента') }}</label>
                                    <div class="col-md-6">
                                        <input id="client-phone" type="number" min="1" class="form-control{{ $errors->has('client-phone') ? ' is-invalid' : '' }}" name="client-phone" value="{{ $reservation->client->phone }}" required>
                                        @if ($errors->has('client-phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('client-phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status-id" class="col-md-4 col-form-label text-md-right">{{ __('Статус') }}</label>
                                    <div class="col-md-6">
                                        <select id="status-id" class="form-control reservations-edit-select" name="status-id">
                                            @foreach($statuses as $status)
                                                @if ($status->id === $reservation->reservationStatus->id)
                                                    <option value="{{$status->id}}" selected>{{$status->title}}</option>
                                                @else
                                                    <option value="{{$status->id}}">{{$status->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-3">
                                        <p><a href="{{ route('reservation.index') }}" class="btn btn-dark btn-default">
                                                {{__('Назад')}}</a></p>
                                    </div>
                                    <div class="col-md-9" style="padding-left: 60%">
                                        <button name="add-button" type="submit" class="btn btn-primary">
                                            {{ __('Добавить') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection