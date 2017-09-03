@extends( "layouts.template" )

@section( "title", "Dashboard de $user->name" )
@include("layouts.header")
@section( "content" )

    <section class="main container">
        <h2 class="page-header title">
            Dashboard de {{ Auth::user()->name }}
            @if ( Auth::user()->is_admin )
                <a href="/admin/dashboard" class="btn-sm btn green pull-right">Retour</a>
            @endif
        </h2>

        <section id="accordion">
            <h3>
                Événéments auxquels je participe

            </h3>

            @foreach($events as $event)
                <section class="single-event">
                    <h4>
                        <a data-toggle="collapse" data-parent="#accordion" href="#exam-{{$event->id}}" class="title-collapse" >
                            {{ $event->course_name }} - {{ $event->academic_year }} - Session {{ $event->exam_session }}
                        </a>
                    </h4>
                    <div id="exam-{{$event->id}}" class="collapse single-event__content">
                        <p><strong>Professeur responsable : {{ $event->owner->name }}</strong></p>
                        <ul>
                        @foreach($event->meetings->where("user_id", $user->id)->where("student_id", "!=", null) as $meeting)
                            <li>
                                <a href="{{ route("events.meetingShow", ["meeting" => $meeting, "event" => $event])}}">
                                    {{ $meeting->student->name }}
                                </a>
                                @if ( is_null($meeting->start_time) && is_null($meeting->end_time) )
                                    <span>Pas d'horaire renseigné</span>
                                @else
                                    <span>
                                        de {{ $meeting->start_time->format("H:i") }}
                                        à {{ $meeting->end_time->format("H:i") }}
                                    </span>
                                @endif

                            </li>
                        @endforeach
                        </ul>
                    </div>
                </section>
            @endforeach
        </section>

    </section>

@endsection
