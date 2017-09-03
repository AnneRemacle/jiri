@extends( "layouts.template" )

@section( "title", "Tous les étudiants" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            Tous les jurys
        </h2>
        <div class="list-group col-sm-8 col-md-offset-2">
            @foreach ($users as $user)
                <section class="list-group-item clearfix">
                    <h3 class="single-item__title">
                        {{ $user->name }}
                        <span class="pull-right small">
                            <a href="{{ route("users.edit", $user) }}" class="btn btn-primary">Modifier</a>
                            <a href="" class="btn btn-danger">Supprimer</a>
                        </span>
                    </h3>
                </section>
            @endforeach
        </div>
    </section>

@endsection
