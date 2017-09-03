@extends( "layouts.template" )

@section( "title", "Tous les étudiants" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            Tous les étudiants
        </h2>
        <div class="list-group col-sm-8 col-md-offset-2">

            @foreach ($students as $student)
                <section class="list-group-item clearfix">
                    <h3 class="single-item__title">
                        {{ $student->name }}
                        <span class="pull-right small">
                            <a href="{{ route( "students.edit", $student ) }}" class="btn btn-primary">Modifier</a>
                            <a href="{{ route( "students.delete", $student ) }}" class="btn btn-danger">Supprimer</a>
                        </span>
                    </h3>
                </section>
            @endforeach
        </div>
    </section>

@endsection
