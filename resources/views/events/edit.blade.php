@extends( "layouts.template" )

@section( "title", "Modifier" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header">Modifier l'événement </h2>
        @include("events.forms.edit")
    </section>
@endsection
