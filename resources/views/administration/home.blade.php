@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{ $user->first_name }} {{ $user->second_name }} авторизован как {{ $user->roles()->pluck('name')->implode(' ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($user->is_admin)
                        <p><a href="{{ route('invitation-key') }}" class="btn btn-success"> Пригласительный ключ для регистрации </a></p>
                        <p><a href="{{ URL::route('users.index') }}" class="btn btn-success"> Управление пользователями </a></p>
                    @endif
                        <p>Something written...</p>
            </div>
        </div>
    </div>
</div>
@endsection
