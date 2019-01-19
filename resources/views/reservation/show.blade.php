@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <h4>{{__('Просмотр заказа')}}</h4>
                        <div class="row">
                            <div class="col-md-3">{{__('Номер')}}</div>
                            <div class="col-md-9">{{$reservation->id}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{__('Столик')}}</div>
                            <div class="col-md-9">{{$reservation->platen->id}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{__('Дата посещения')}}</div>
                            <div class="col-md-9">{{$reservation->date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{__('Статус')}}</div>
                            <div class="col-md-9">{{$reservation->reservationStatus->title}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{__('Клиент')}}</div>
                            <div class="col-md-9">{{$reservation->client ? $reservation->client->name : __('Не указан')}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{__('Телефон клиента')}}</div>
                            <div class="col-md-9">{{$reservation->client ? $reservation->client->phone : __('Не указан')}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{__('Количество гостей')}}</div>
                            <div class="col-md-9">{{$reservation->count_persons}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{__('Комментарий')}}</div>
                            <div class="col-md-9">{{$reservation->comment ?: __('Отсутсвует')}}</div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <p><a href="{{ route('reservation.index') }}" class="btn btn-dark btn-default">
                                        {{__('Назад')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection