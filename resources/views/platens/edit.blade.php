@extends('layouts.app')

@section('title', '| Edit Platen')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирование стола

                        <div class="card-body">

                            <form method="POST" action="{{ URL::route('platens.update', $platen->id) }}">
                                {{ method_field('PUT') }}
                                @csrf

                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Название') }}</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $platen->title }}" required autofocus>

                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="platen_capacity" class="col-md-4 col-form-label text-md-right">{{ __('Количество мест') }}</label>

                                    <div class="col-md-6">
                                        <input id="platen_capacity" type="number" class="form-control{{ $errors->has('platen_capacity') ? ' is-invalid' : '' }}" name="platen_capacity" value="{{ $platen->capacity }}" required>

                                        @if ($errors->has('platen_capacity'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('platen_capacity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="create-edit-buttons-container">
                                    <div>
                                        <a href="{{ route('platens.index') }}" class="btn btn-default">
                                            {{__('Назад')}}</a>
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