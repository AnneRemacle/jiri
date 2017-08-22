@extends( "layouts.template" )

@section( "title", "Ajouter un étudiant" )

@section( "content" )
    <h1>Ajouter un étudiant</h1>

    @include("student.forms.create")
@endsection
