@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{__('Изменение схемы')}}

                        <div class="card-body">

                            <form method="POST" action="{{ route('scheme.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <label for="scheme-file" class="col-md-12 col-form-label text-center">{{ __('Загрузите картинку схемы столов') }}</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="scheme-file" class="center-block" type="file" name="scheme-file"
                                               accept=".jpg, .jpeg, .png" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-3">
                                        <p><a href="{{ route('scheme.show') }}" class="btn btn-dark btn-default">
                                                {{__('Назад')}}</a></p>
                                    </div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-4">
                                        <button name="add-button" type="submit" class="btn btn-primary">
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