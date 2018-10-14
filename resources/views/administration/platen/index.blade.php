{{-- \resources\views\users\index.blade.php --}}

<?php
use \App\Http\Models\Role\RoleType;
?>
@extends('layouts.app')

@section('title', '| Users')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Столы
        </h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Описание</th>
                    <th>Количество мест</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($platens as $platen)
                    <tr>

                        <td>{{ $platen->title }}</td>
                        <td>{{ $platen->capacity }}</td>
                        <td>
                            @if(!$user->hasRole(RoleType::ADMINISTRATOR))
                                <p><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Редактировать</a></p>

                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                                {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <p><a href="{{ route('invitation-key') }}" class="btn btn-success"> Пригласительный ключ для регистрации </a></p>

    </div>

@endsection