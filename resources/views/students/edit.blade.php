@extends( "layouts.template" )

@section( "title", "Modifier un étudiant" )

@section( "content" )
    <h1>Modifier un étudiant</h1>

    @include("student.forms.edit")
@endsection
