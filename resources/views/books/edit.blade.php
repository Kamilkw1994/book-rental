@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edytuj</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Cofnij</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Nastąpił problem w stworzeniu nowej książki<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update',$book->id) }}" method="POST">

        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tytuł:</strong>
                    <input type="text" name="title" value="{{ $book->title }}" class="form-control" placeholder="Tytuł">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Opis:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Opis">{{ $book->description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="authors">Autorzy:</label>
                <select name="authors[]" multiple>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ $book->authors->contains('id', $author->id) ? 'selected' : '' }}>
                            {{ $author->first_name }} {{ $author->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Aktualizuj</button>
            </div>
        </div>
    </form>

@endsection
