@extends('authors.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista autorów</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('books.index') }}">Lista książek</a>
                <a class="btn btn-success" href="{{ route('authors.create') }}">Dodaj nowego autora</a>
            
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
            <th>Imię</th>
            <th>Nazwisko</th>
            <th width="280px">Akcja</th>
        </tr>

        @foreach ($authors as $author)

        <tr>
            <td>{{ $author->id }}</td>
            <td>{{ $author->first_name }}</td>
            <td>{{ $author->last_name }}</td>
            <td>
                <form action="{{ route('authors.destroy',$author->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('authors.show',$author->id) }}">Szczegóły</a>
                    <a class="btn btn-primary" href="{{ route('authors.edit',$author->id) }}">Edycja</a>

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
                <a href="{{ route('authors.index') }}?page={{ $i }}">{{ $i }}</a>
            @endfor
        </ul>
@endsection

