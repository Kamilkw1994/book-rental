@extends('authors.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edytuj</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('authors.index') }}"> Cofnij</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Nastąpił problem w stworzeniu nowego autora<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('authors.update',$author->id) }}" method="POST">

        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Imię:</strong>
                    <input type="text" name="first_name" value="{{ $author->first_name }}" class="form-control" placeholder="Imię">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nazwisko:</strong>
                    <input type="text" name="last_name" value="{{ $author->last_name }}" class="form-control" placeholder="Nazwisko">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Aktualizuj</button>
            </div>
        </div>
    </form>

@endsection
