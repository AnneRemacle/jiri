@extends( "layouts.template" )

@section( "title", "Modifier un utilisateur" )

@section( "content" )
    <h1>Modifier un utilisateur</h1>

    @include("users.forms.edit")
@endsection
