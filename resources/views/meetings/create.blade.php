@extends( "layouts.template" )

@section( "title", "Créer l'ordre de passage" )

@section( "content" )
    <section class="main">
        <h1>Créer l'ordre de passage</h1>

        @include("meetings.forms.create")
    </section>
@endsection
