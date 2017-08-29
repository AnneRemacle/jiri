@extends( "layouts.template" )

@section( "title", "Ajouter un utilisateur" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header">Ajouter un utulisateur</h2>
        @include("users.forms.create")
    </section>
@endsection
