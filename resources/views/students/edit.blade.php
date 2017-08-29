@extends( "layouts.template" )

@section( "title", "Modifier un étudiant" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header">Modifier un étudiant</h2>
        @include("students.forms.edit")
    </section>
@endsection
