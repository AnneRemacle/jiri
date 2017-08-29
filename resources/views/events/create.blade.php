@extends( "layouts.template" )

@section( "title", "Créer un événement" )
@include('layouts.header')

@section( "content" )
    <section class="container">
        <h2 class="page-header">Créer un événement</h2>
        @include("events.forms.create")
    </section>
@endsection
