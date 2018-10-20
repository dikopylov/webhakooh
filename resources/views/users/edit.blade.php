{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.app')

@section('title', '| Edit User')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирование пользователя

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ URL::route('users.update', $user->id) }}">
                            {{ method_field('PUT') }}
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Логин') }}</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="login" value="{{ $user->login }}" required readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $user->first_name }}" required readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="second_name" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

                                <div class="col-md-6">
                                    <input id="second_name" type="text" class="form-control{{ $errors->has('second_name') ? ' is-invalid' : '' }}" name="second_name" value="{{ $user->second_name }}" required readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Назначить роль') }}</label>
                                <div class="col-md-6">
                                    @foreach ($roles as $role)
                                        @if(stristr($user->roles()->pluck('name')->implode(' '), $role->name))
                                        <input name="roles[]" type="radio" value="{{ $role->id }}" checked>
                                        <label for="{{ $role->name }}">{{ $role->name }}</label><br>
                                        @else
                                        <input name="roles[]" type="radio" value="{{ $role->id }}">
                                        <label for="{{ $role->name }}">{{ $role->name }}</label><br>
                                        @endif
                                    @endforeach
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
    </div>

@endsection