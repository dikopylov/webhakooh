@extends('layouts.app')

@section('title', '| Platens')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Столы
        <a href="{{ route('platens.create') }}" class="btn btn-success">Добавить новый стол</a></h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Название</th>
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
                            <p><a href="{{ route('platens.edit', $platen->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Редактировать</a></p>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['platens.destroy', $platen->id] ]) !!}
                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection