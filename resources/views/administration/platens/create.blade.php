{{-- \resources\views\platens\create.blade.php --}}
@extends('layouts.app')

@section('title', '| Create New Platen')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-user-plus'></i>Добавить новый стол</h1>
        <hr>
        <form method="POST" action="{{ route('platens.store') }}">
            @csrf
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Название') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('Количество мест') }}</label>

                <div class="col-md-6">
                    <input id="capacity" type="text" class="form-control{{ $errors->has('capacity') ? ' is-invalid' : '' }}" name="capacity" value="{{ old('capacity') }}" required>

                    @if ($errors->has('capacity'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('capacity') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Добавить') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection