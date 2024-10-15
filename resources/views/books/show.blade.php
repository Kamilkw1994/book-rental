@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Dane książki</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Cofnij</a>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tytuł:</strong>
                    {{ $book->title }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Opis:</strong>
                    {{ $book->description }}
                </div>
            </div>

            <div class="form-group">
                <strong>Autor:</strong>
                @foreach($book->authors as $author)
                {{ $author->first_name }} {{ $author->last_name }};
            @endforeach
            </div>
        </div>


@endsection
