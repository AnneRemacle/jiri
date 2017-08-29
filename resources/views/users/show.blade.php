@extends( "layouts.template" )

@section( "title", "Super Jury" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header">{{ $user->name }}</h2>
        @include("users.forms.delete")
        @include("users.forms.edit")
    </section>
@endsection
