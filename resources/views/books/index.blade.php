@extends('books.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista książek</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('authors.index') }}">Lista autorów</a>
                <a class="btn btn-success" href="{{ route('books.create') }}">Dodaj nową książkę</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Opis</th>
            <th>Autor</th>
            <th width="280px">Akcja</th>
        </tr>

        @foreach ($books as $book)

        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->description }}</td>
            <td>
                @foreach($book->authors as $author)
                    {{ $author->first_name }} {{ $author->last_name }};
                @endforeach
            </td>
            <td>
                <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">Szczegóły</a>
                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edycja</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Usuń</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
        <!-- Paginacja napisana w czystym PHP -->
        <ul>
            @for($i = 1; $i <= $totalPages; $i++)
                <a href="{{ route('books.index') }}?page={{ $i }}">{{ $i }}</a>
            @endfor
        </ul>
@endsection

