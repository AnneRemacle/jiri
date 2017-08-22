@extends( "layouts.template" )

@section( "title", "Dashboard de $user->name" )

@section( "content" )
    @include("layouts.header")
    <nav class="nav">
        <h2 class="nav__title">Options disponibles</h2>
        <a href="{{ route("events.create") }}" class="nav__button">Créer un événement</a>
        <a href="{{ route("user.events") }}" class="nav__button">Mes événements</a>
    </nav>

    <section class="main">
        <h2 class="title">{{ $event->course_name }} - {{ $event->academic_year }} - session n° {{ $event->exam_session }}</h2>
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