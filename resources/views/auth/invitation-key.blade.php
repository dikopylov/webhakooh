@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Регистрация') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('check-invitation-key') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="invitation-key" class="col-sm-4 col-form-label text-md-right">{{ __('Пригласительный ключ') }}</label>

                            <div class="col-md-6">
                                <input id="invitation-key" type="text" class="form-control{{ $errors->has('invitation-key') ? ' is-invalid' : '' }}" name="invitation-key" required autofocus>

                                @if ($errors->has('invitation-key'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('invitation-key') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Отправить') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
