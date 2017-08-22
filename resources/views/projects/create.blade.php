@extends( "layouts.template" )

@section( "title", "Créer un projet" )

@section( "content" )
    <h1>Créer un projet</h1>

    @include("project.forms.create")
@endsection
