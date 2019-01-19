@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                    <h4>{{__('Контакты')}}</h4>
                        <div class="row">
                            <div class="col-md-3">{{__('Адрес')}}</div>
                            <div class="col-md-9">{{$contact->address}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{__('Телефон')}}</div>
                            <div class="col-md-9">{{$contact->phone}}</div>
                        </div>
                        <div class="row pull-right">
                            <div class="col-md-3">
                                <p><a href="{{ route('contacts.edit') }}" class="btn btn-dark btn-success">
                                        {{__('Изменить')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection