@extends( "layouts.template" )

@section( "title", "Projet machin" )

@section( "content" )
    <section class="container">
        <h2 class="page-header">{{ $projetc->name }}</h2>
        @include("project.forms.delete")
        @include("project.forms.edit")
    </section>
@endsection
