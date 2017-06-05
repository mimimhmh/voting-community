@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            @include('community.list')
        </div>

        @include('community.add-link')

    </div>

@endsection