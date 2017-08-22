@extends( "layouts.template" )

@section( "title", "Modifier un projet" )

@section( "content" )
    <h1>Modifier un projet</h1>

    @include("project.forms.edit")
@endsection
