@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <h4>{{__('Просмотр заказа')}}</h4>
                        <div class="row margin">
                            <div class="col-md-3 text-bold">{{__('Номер')}}</div>
                            <div class="col-md-9">
                                <input type="text" disabled value="{{$reservation->id}}">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="col-md-3 text-bold">{{__('Столик')}}</div>
                            <div class="col-md-9">
                                <input type="text" disabled value="{{$reservation->platen->id}}">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="col-md-3 text-bold">{{__('Дата посещения')}}</div>
                            <div class="col-md-9">
                                <input type="text" disabled value="{{$reservation->date}}">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="col-md-3 text-bold">{{__('Статус')}}</div>
                            <div class="col-md-9">
                                <input type="text" disabled value="{{$reservation->reservationStatus->title}}">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="col-md-3 text-bold">{{__('Клиент')}}</div>
                            <div class="col-md-9">
                                <input type="text" disabled value="{{$reservation->client ? $reservation->client->name : __('Не указан')}}">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="col-md-3 text-bold">{{__('Телефон клиента')}}</div>
                            <div class="col-md-9">
                                <input type="text" disabled value="{{$reservation->client ? $reservation->client->phone : __('Не указан')}}">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="col-md-3 text-bold">{{__('Количество гостей')}}</div>
                            <div class="col-md-9">
                                <input type="text" disabled value="{{$reservation->count_persons}}">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="col-md-3 text-bold">{{__('Комментарий')}}</div>
                            <div class="col-md-9">
                                <input type="text" disabled value="{{$reservation->comment ?: __('Отсутсвует')}}">
                            </div>
                        </div>
                        @if ($reservation->cancel_reason)
                            <div class="row margin">
                                <div class="col-md-3 text-bold">{{__('Причина отклонения')}}</div>
                                <div class="col-md-9">
                                    <input type="text" disabled value="{{$reservation->cancel_reason}}">
                                </div>
                            </div>
                        @endif
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