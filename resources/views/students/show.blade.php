@extends( "layouts.template" )

@section( "title", "john snow" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header">{{ $student->name }}</h2>
        @include("students.forms.delete")
        @include("students.forms.edit")
    </section>
@endsection
