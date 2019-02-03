{{-- \resources\views\users\index.blade.php --}}

<?php
use \App\Http\Models\Role\RoleType;
?>
@extends('layouts.app')

@section('title', '| Users')

@section('content')

    <div class="col-lg-12">
        <h1><i class="fa fa-users"></i> Пользователи
        </h1>

        <a href="{{ route('invitation-key') }}" class="btn btn-success"> Пригласительный ключ для регистрации </a>
        <hr>
        @if (isset($message))
            <div class="alert alert-success col-3 text-center alert-dismissible platen-alert-block" role="alert">
                <button type="button" class="close platen-close-alert-button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{$message}}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Логин</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Дата/Время добавления</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($users as $user)
                    <tr id="{{ $user->id }}">

                        <td>{{ $user->id }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->second_name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                        <td>
                            <p><a href="{{ route('log.changes.by.user', $user->id) }}" class="btn btn-info pull-left"
                                  style="margin-right: 3px;">Посмотреть действия</a></p>
                            @if(!$user->hasRole(RoleType::ADMINISTRATOR))
                                <p><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left"
                                      style="margin-right: 3px;">Редактировать</a></p>


                                <p><a href="javascript:void(0);"
                                      onclick="deleteItem({{ $user->id . ', \'' . route('users.destroy', [$user->id]) . '\''}})"
                                      class="btn btn-danger pull-left" style="margin-right: 3px;">Удалить</a></p>

                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$users->links()}}
        <p><a href="{{ route('invitation-key') }}" class="btn btn-success"> Пригласительный ключ для регистрации </a></p>

    </div>

@endsection