@extends( "layouts.template" )

@section( "title", $event->course_name )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="title page-header">Détails de l'événement&nbsp;: {{ $event->course_name }} - {{ $event->academic_year }} - session n° {{ $event->exam_session }}</h2>

        <nav class="nav-buttons">
            <h3 class="nav-title">Options disponibles</h3>

            <a href="{{ route("projects.manage", $event) }}" class="btn btn-primary">Gérer les projets</a>
            @if( $event->projects->count() )
                <a href="{{ route("students.manage", $event) }}" class="btn btn-primary">Gérer les étudiants</a>
            @endif

            @if( $event->implementations->count() )
                <a href="{{ route("users.manage", $event) }}" class="btn btn-primary">Gérer les jurés</a>
            @endif
        </nav>

        @if( $event->meetings->count() )
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        @foreach( $event->users as $jury )
                            <th colspan="{{ $event->projects->count() }}">{{ $jury->name }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th></th>
                        @for ($i=0; $i < $event->users->count(); $i++)
                            @foreach ( $event->projects as $project )
                                <th>{{ $project->name }}</th>
                            @endforeach
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach( $event->performances as $performance )
                        <tr>
                            <th><a href="{{ route("events.showStudent", ["event" => $event, "student" => $performance->student]) }}">{{ $performance->student->name }}</a></th>
                            @foreach( $event->users as $jury )
                                @if( $event->meetings->where("user_id", $jury->id)->where("student_id", $performance->student->id)->count() )
                                    @foreach( $event->meetings->where("user_id", $jury->id)->where("student_id", $performance->student->id)->first()->scores as $score )
                                        <td>{{ $score->score }}</td>
                                    @endforeach
                                @else
                                    <td colspan="{{ $event->projects->count() }}">No meeting</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif
    </section>
@endsection
