@extends('layouts.app')

@section('title', '| Activity log')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i>Просмотр действий пользователя {{ $user->login }}
        </h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Место</th>
                    <th>Описание</th>
                    <th>ID субъекта</th>
                    <th>Время</th>
                    <th>Изменения</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($user->activity as $log)
                    <tr>
                        <td>{{ $log->log_name }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->subject_id }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td>
                            <p><a href="{{ route('log.changes', $log->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">
                                    Посмотреть</a></p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection