@extends('layouts.app')

@section('title', '| Show Changes')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Просмотр изменений

                        @if(isset($changes['old']))
                            <div class="card-body">
                                <h4>Устаревшие данные</h4>
                                @foreach($changes['old'] as $key => $value)
                                    <div class="form-group row">
                                        <label for="old" class="col-md-4 col-form-label text-md-right">{{ $key }}</label>
                                        <div class="col-md-6">
                                                <input id="{{ $key }}" type="text" class="form-control" name="title" value="{{ $value }}" required readonly>
                                        </div>
                                    </div>
                                @endforeach
                        @endif

                        <div class="card-body">
                            <h4>Актуальные данные</h4>
                            @foreach($changes['attributes'] as $key => $value)
                                <div class="form-group row">
                                    <label for="old" class="col-md-4 col-form-label text-md-right">{{ $key }}</label>
                                    <div class="col-md-6">
                                        <input id="{{ $key }}" type="text" class="form-control" name="title" value="{{ $value }}" required readonly>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <p><a href="{{ route('logs') }}" class="btn btn-info pull-left" style="margin-right: 3px;">
                                                Назад</a></p>
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