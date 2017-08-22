@extends( "layouts.template" )

@section( "title", "Super Jury" )

@section( "content" )
    <h1>Super Jury</h1>

    @include("users.forms.delete")
    @include("users.forms.edit")
@endsection
