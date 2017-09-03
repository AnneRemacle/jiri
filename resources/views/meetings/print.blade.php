@extends( "layouts.template" )

@section( "title", $event->course_name )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            Imprimer les meetings
            <a href="{{ route("events.show", $event) }}" class="btn-sm btn green">Retour</a>
        </h2>
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                          <li class="active" role="presentation"><a data-toggle="tab" href="#projects">Horaire des jurys</a></li>
                          <li role="presentation"><a data-toggle="tab" href="#users">Horaire des étudiants</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="fade in tab-pane active" id="projects">
                                <a href="{{ route("meetings.getUserMeetingsPDF", $event) }}" class="btn btn-primary" target="_blank">Imprimer</a>
                                <section class="single-item">
                                    @foreach( $event->users as $user )
                                        <h3>{{ $user->name }}</h3>
                                        <p><strong>Email: </strong>{{ $user->email }}</p>
                                        <p><strong>Mot de passe: </strong>{{ $user->clear_password }}</p>
                                        @foreach( $event->meetings->where("user_id", $user->id) as $meeting )
                                            {{ $meeting->student->name }}:
                                            @if ( is_null($meeting->start_time) && is_null($meeting->end_time) )
                                                <span>Pas d'horaire renseigné</span>
                                            @else
                                                <span>
                                                    de {{ $meeting->start_time->format("H:i") }}
                                                    à {{ $meeting->end_time->format("H:i") }}
                                                </span>
                                            @endif
                                            <br/>
                                        @endforeach
                                    @endforeach
                                </section>
                            </div>
                            <div role="tabpanel" class="fade tab-pane" id="users">
                                <a href="{{ route("meetings.getStudentMeetingsPDF", $event) }}" class="btn btn-primary" target="_blank">Imprimer</a>
                                <section class="single-item">
                                    @foreach( $event->students as $student )
                                        <h3>{{ $student->name }}</h3>
                                        @foreach( $event->meetings->where("student_id", $student->id) as $meeting )
                                            {{ $meeting->user->name }}:
                                            @if ( is_null($meeting->start_time) && is_null($meeting->end_time) )
                                                <span>Pas d'horaire renseigné</span>
                                            @else
                                                <span>
                                                    de {{ $meeting->start_time->format("H:i") }}
                                                    à {{ $meeting->end_time->format("H:i") }}
                                                </span>
                                            @endif
                                            <br/>
                                        @endforeach
                                    @endforeach
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
