@extends( "layouts.template" )

@section( "title", "Dashboard de $user->name" )
@include("layouts.header")
@section( "content" )
    <section class="container">
        <h2 class="page-header">Événements de {{$user->name}}</h2>

        <ul class="events list-group col-sm-6 offset-md-2">
            @foreach ($events as $event)
                <li class="list-group-item">
                    <a href="{{ route("events.show", $event) }}">{{ $event->course_name }}</a>
                    @include('events.forms.delete')
                </li>

            @endforeach
        </ul>

    </section>

@endsection
