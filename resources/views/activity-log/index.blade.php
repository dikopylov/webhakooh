<?php
use \App\Http\Models\Role\RoleType;
?>
@extends('layouts.app')

@section('title', '| Activity log')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i>Логи
        </h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Место</th>
                    <th>Описание</th>
                    <th>ID субъекта</th>
                    <th>ID пользователя</th>
                    <th>Логин</th>
                    <th>Время</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->log_name }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->subject_id }}</td>
                        <td>{{ $log->causer_id }}</td>
                        <td>{{ $log->causer_type }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection