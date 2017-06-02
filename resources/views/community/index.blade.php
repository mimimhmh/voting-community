@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1> Community </h1>
                <ul class="Links">
                    @foreach($links as $link)
                        <li class="Links__link">
                            <a href="{{ $link->link }}" target="_blank">
                                {{ $link->title }}
                            </a>

                            <small>
                                contributed by:
                                <a href="#">
                                    {{ $link->creator->name }}
                                </a>
                                {{ $link->updated_at->diffForHumans() }}
                            </small>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4">
                <h3>Contribute a Link</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="/community">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">Title: </label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Enter title">
                            </div>

                            <div class="form-group">
                                <label for="link">Link: </label>
                                <input class="form-control" id="link" name="link" placeholder="Your URL">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Contribute Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection