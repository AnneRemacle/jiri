@extends( "layouts.template" )

@section( "title", "Ajouter un étudiant" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header">Ajouter un étudiant</h2>
        @include("students.forms.create")
    </section>
@endsection
