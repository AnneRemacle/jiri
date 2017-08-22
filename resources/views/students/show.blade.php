@extends( "layouts.template" )

@section( "title", "john snow" )

@section( "content" )
    <h1>john snow</h1>

    @include("student.forms.delete")
    @include("student.forms.edit")
@endsection
