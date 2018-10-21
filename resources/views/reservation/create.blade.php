@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Добавить новое бронирование')}}
                        <div class="card-body">
                            <form method="POST" action="{{ route('reservation.create') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="platen-id" class="col-md-4 col-form-label text-md-right">{{ __('Номер столика') }}</label>
                                    <div class="col-md-6">
                                        <select id="platen-id" class="form-control" name="platen-id">
                                            @foreach($platens as $platen)
                                                <option value="{{$platen->id}}">{{$platen->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="visit-date" class="col-md-4 col-form-label text-md-right">{{ __('Дата и время посещения') }}</label>
                                    <div class="col-md-6">
                                        <input id="visit-date" type="datetime-local" class="form-control{{ $errors->has('visit-date') ? ' is-invalid' : '' }}" name="visit-date"  min="{{$minDate}}" max="{{$maxDate}}" value="{{ old('visit-date') }}" required autofocus>
                                        @if ($errors->has('visit-date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('visit-date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="platen_capacity" class="col-md-4 col-form-label text-md-right">{{ __('Количество гостей') }}</label>
                                    <div class="col-md-6">
                                        <input id="platen_capacity" type="number" class="form-control{{ $errors->has('capacity') ? ' is-invalid' : '' }}" name="platen_capacity" value="{{ old('platen_capacity') }}" required>
                                        @if ($errors->has('platen_capacity'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('platen_capacity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Добавить') }}
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