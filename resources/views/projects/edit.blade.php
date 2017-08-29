@extends( "layouts.template" )

@section( "title", "Modifier un projet" )

@section( "content" )
    <section class="container">
        <h2 class="page-header">Modifier un projet</h2>
        @include("projects.forms.edit")
    </section>
@endsection
