{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.app')

@section('title', '| Add User')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Регистрация') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Логин') }}</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                    @if ($errors->has('login'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

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
                                    <input id="patronymic" type="text" class="form-control{{ $errors->has('patronymic') ? ' is-invalid' : '' }}" name="patronymic" value="{{ old('patronymic') }}" required autofocus>

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
                                    <input id="second_name" type="text" class="form-control{{ $errors->has('second_name') ? ' is-invalid' : '' }}" name="second_name" value="{{ old('second_name') }}" required autofocus>

                                    @if ($errors->has('second_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('second_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Мобильный телефон') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

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
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Повторите пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <input type="hidden" name="invitation_key" value="{{ session('invitation_key') }}">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Добавить пользователя') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class='col-lg-4 col-lg-offset-4'>--}}

        {{--<h1><i class='fa fa-user-plus'></i>Добавить пользователя</h1>--}}
        {{--<hr>--}}

        {{--{{ Form::open(array('url' => 'users')) }}--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('login', 'Логин') }}--}}
            {{--{{ Form::text('login', '', array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('first_name', 'Имя') }}--}}
            {{--{{ Form::text('first_name', '', array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('second_name', 'Фамилия') }}--}}
            {{--{{ Form::text('second_name', '', array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('phone', 'Телефон') }}--}}
            {{--{{ Form::email('phone', '', array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('email', 'Email') }}--}}
            {{--{{ Form::email('email', '', array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        {{--<div class='form-group'>--}}
            {{--@foreach ($roles as $role)--}}
                {{--{{ Form::checkbox('roles[]',  $role->id ) }}--}}
                {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}

            {{--@endforeach--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('password', 'Password') }}<br>--}}
            {{--{{ Form::password('password', array('class' => 'form-control')) }}--}}

        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('password', 'Confirm Password') }}<br>--}}
            {{--{{ Form::password('password_confirmation', array('class' => 'form-control')) }}--}}

        {{--</div>--}}

        {{--{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

        {{--{{ Form::close() }}--}}

    {{--</div>--}}

@endsection