@extends( "layouts.template" )

@section( "title", "Dashboard de $user->name" )

@section( "content" )
    @include("layouts.header")

    <section class="main">
        <h2>Événements de {{$user->name}}</h2>

        <ul class="events">
            @foreach ($events as $event)
                <li>
                    <a href="{{ route("events.show", $event) }}">{{ $event->course_name }}</a>
                </li>
            @endforeach
        </ul>

    </section>

@endsection
