@extends( "layouts.template" )

@section( "title", "Créer un événement" )
@include('layouts.header')

@section( "content" )
    <section class="container">
        <h2 class="page-header title">Créer un événement</h2>

        @if ( $errors->any() )
            <div class="alert alert-danger col-sm-8 col-md-offset-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include("events.forms.create")
    </section>
@endsection
