@extends( "layouts.template" )

@section( "title", "john snow" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header">{{ $student->name }}</h2>
        @include("student.forms.delete")
        @include("student.forms.edit")
    </section>
@endsection
