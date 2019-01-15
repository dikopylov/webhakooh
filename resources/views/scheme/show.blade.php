@extends('layouts.app')

@section('content')
<?php
/** @var \App\Http\Models\Scheme\PlatensScheme $scheme */
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                    <h4 class="margin-bottom">{{__('Схема столов')}}</h4>
                        <div class="row margin-bottom">

                            <div class="col-md-12 align-content-center">
                                <img class="scheme-platens_scheme center-block " src="{{ $scheme->base64 }}"
                                     alt="Схема расположения столов"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-3">
                                <p><a href="{{ route('scheme.edit') }}" class="btn btn-dark btn-success">
                                        {{__('Изменить')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection