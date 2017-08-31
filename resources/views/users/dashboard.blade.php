@extends( "layouts.template" )

@section( "title", "Dashboard de $user->name" )
@include("layouts.header")
@section( "content" )

    <section class="main container">
        <h2 class="hide">Dashboard du jury</h2>
        @foreach($events as $event)
            <section class="row">
                <h3>{{ $event->course_name }} - {{ $event->academic_year }} - Session {{ $event->exam_session }}</h3>
                <p><strong>Professeur responsable : {{ $event->owner->name }}</strong></p>
                <ul>
                @foreach($event->meetings->where("user_id", $user->id) as $meeting)
                    <li>
                        <a href="{{ route("events.meetingShow", ["meeting" => $meeting, "event" => $event])}}">
                            {{ $meeting->student->name }}
                            de {{ is_null($meeting->start_time) ? "pas d'heure" : $meeting->start_time->format("H:i") }}
                            à {{ is_null($meeting->end_time) ? "pas d'heure" : $meeting->end_time->format("H:i") }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </section>
        @endforeach
    </section>

@endsection
