@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            getReservations('{{$currentKey}}', '{{$message}}', '{{$alert}}', '{{route('reservation.show-all')}}');
            setInterval(function() {
                getReservations('{{$currentKey}}', '{{$message}}', '{{$alert}}', '{{route('reservation.show-all')}}');
            }, 5000);
        });
    </script>
@endsection