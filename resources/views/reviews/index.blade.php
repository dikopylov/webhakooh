@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1><i class="fa fa-users"></i> {{__('Отзывы клиентов')}}</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center">{{__('Номер')}}</th>
                    <th class="text-center">{{__('Имя клиента')}}</th>
                    <th class="text-center">{{__('Текст')}}</th>
                    <th class="text-center">{{__('Действия')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var \App\Http\Models\Reservation\Reservation $reservation */  ?>
                @foreach ($reviews as $review)
                    <tr id="{{ $review->id }}">
                        <td class="text-center">{{ $review->id }}</td>
                        <td class="text-center">{{ $review->client->name }}</td>
                        <td class="text-justify">{{ $review->content }}</td>
                        <td class="align-content-center text-center">

                                <a href="javascript:void(0);"
                                   onclick="deleteItem({{ $review->id. ', \'' . route('reviews.destroy', [$review->id]) . '\''}})"
                                   class="btn btn-danger" style="margin-right: 3px;">Удалить</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$reviews->links()}}
    </div>
@endsection