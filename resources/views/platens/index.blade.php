@extends('layouts.app')

@section('title', '| Platens')

@section('content')

    <div class="col-lg-12">
        <h1><i class="fa fa-users"></i> Столы
        <a href="{{ route('platens.create') }}" class="btn btn-success">Добавить новый стол</a></h1>
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
                    <th>Название</th>
                    <th>Количество мест</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($platens as $platen)
                    <tr id="{{ $platen->id }}">

                        <td>{{ $platen->id }}</td>
                        <td>{{ $platen->title }}</td>
                        <td>{{ $platen->capacity }}</td>
                        <td>
                            <div class="row col-sm-10">
                                <a href="{{ route('platens.edit', $platen->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Редактировать</a>

                                <a href="javascript:void(0);"
                                      onclick="deleteItem({{ $platen->id . ', \'' . route('platens.destroy', [$platen->id]) . '\''}})"
                                      class="btn btn-danger" style="margin-right: 3px;">Удалить</a>
                            </div>
                            <div class="col-sm-2"></div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$platens->links()}}
    </div>

@endsection