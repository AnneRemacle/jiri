@extends( "layouts.template" )

@section( "title", $event->course_name )

@section( "content" )

    <h1>Modifier l'évènement : {{ $event->course_name }}</h1>

    <section class="main">
        <h2 class="title">{{ $event->course_name }} - {{ $event->academic_year }} - session n° {{ $event->exam_session }}</h2>
        <a href="{{ route("events.inviteStudent", $event) }}" class="btn btn-primary">Ajouter un étudiant</a>
        <a href="{{ route("events.inviteJury", $event) }}" class="btn btn-primary">Ajouter un jury</a>

        <table class="table">
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
                @foreach( $event->students as $student )
                    <tr>
                        <th>{{ $student->name }}</th>
                        @foreach( $event->users as $jury )
                            @if( $event->meetings->where("user_id", $jury->id)->where("student_id", $student->id)->count() )
                                @foreach( $event->meetings->where("user_id", $jury->id)->where("student_id", $student->id)->first()->scores as $score )
                                    <td>{{ $score->score }}</td>
                                @endforeach
                            @else
                                <td colspan="6">No meeting</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>

        </table>
    </section>

@endsection
