@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{__('Редактирование контактов')}}

                        <div class="card-body">

                            <form method="POST" action="{{ route('contacts.update') }}">
                                {{ method_field('PUT') }}
                                @csrf

                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Адрес') }}</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="address" value="{{ $contact->address }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="platen_capacity" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>

                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="phone" value="{{ $contact->phone }}" required>
                                    </div>
                                </div>

                                <div class="create-edit-buttons-container">
                                    <div>
                                        <p><a href="{{ route('contacts.show') }}" class="btn btn-dark btn-default">
                                                {{__('Назад')}}</a></p>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Сохранить') }}
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