@extends( "layouts.template" )

@section( "title", "Modifier un utilisateur" )
@include("layouts.header")
@section( "content" )
    <section class="container">
        <h2 class="page-header">Modifier un utulisateur</h2>
        @include("users.forms.edit")
    </section>
@endsection
