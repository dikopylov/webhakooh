@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                    <h3>Редактирование данных</h3>
                        </div>
                    {!! Form::open(['method' => 'POST', 'route' => ['delete-myself', Auth::user()->id] ]) !!}
                    {!! Form::submit('Удалить себя', ['class' => 'float-right btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form method="POST" action="{{ URL::route('edit/profile') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ Auth::user()->first_name }}" required autofocus>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="patronymic" class="col-md-4 col-form-label text-md-right">{{ __('Отчество') }}</label>

                                <div class="col-md-6">
                                    <input id="patronymic" type="text" class="form-control{{ $errors->has('patronymic') ? ' is-invalid' : '' }}" name="patronymic" value="{{ Auth::user()->patronymic }}" required autofocus>

                                    @if ($errors->has('patronymic'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('patronymic') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="second_name" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

                                <div class="col-md-6">
                                    <input id="second_name" type="text" class="form-control{{ $errors->has('second_name') ? ' is-invalid' : '' }}" name="second_name" value="{{ Auth::user()->second_name }}" required autofocus>

                                    @if ($errors->has('second_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('second_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Номер телефона') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ Auth::user()->phone }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail адрес') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
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
@endsection