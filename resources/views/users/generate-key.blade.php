@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <p>
                    <div class="card-header">{{ Auth::user()->first_name }} {{ Auth::user()->second_name }} авторизован как
                        @if (Auth::user()->is_admin)
                            администратор
                        @else
                            сотрудник
                        @endif
                    </div>
                </p>

                <div class="card-body">

                    <form method="POST" action="{{ route('create-key') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="invitation_key" class="col-sm-4 col-form-label text-md-right">{{ __('Пригласительный ключ') }}</label>

                            <div class="col-md-6">
                                <input id="invitation_key" type="text" class="form-control" name="invitation_key" value="{{ $invitationKey }}" readonly autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Новый ключ') }}
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
