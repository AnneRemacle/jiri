@extends( "layouts.template" )

@section( "title", "Projet machin" )

@section( "content" )
    <h1>projet machin</h1>

    @include("project.forms.delete")
    @include("project.forms.edit")
@endsection
