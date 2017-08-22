@extends( "layouts.template" )

@section( "title", "Ajouter un utilisateur" )

@section( "content" )
    <h1>Ajouter un utilisateur</h1>

    @include("users.forms.create")
@endsection
