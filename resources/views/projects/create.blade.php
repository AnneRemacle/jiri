@extends( "layouts.template" )

@section( "title", "Créer un projet" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header">Créer un projet</h2>
        @include("projects.forms.create")
    </section>
@endsection
