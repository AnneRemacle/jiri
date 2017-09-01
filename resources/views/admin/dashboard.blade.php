@extends( "layouts.template" )

@section( "title", "Dashboard de $user->name" )
@include("layouts.header")
@section( "content" )
    <nav class="navbar col-sm-8 col-md-offset-1">
        <h2 class="nav__title hidden">Options disponibles</h2>
        <a href="{{ route("events.create") }}" class="btn btn-primary nav-item">Créer un événement</a>
        <a href="{{ route("users.events") }}" class="btn btn-primary nav-item">Mes événements</a>
        <a href="/dashboard" class="btn btn-primary">Mes meetings</a>
    </nav>

    <section class="main container" style="overflow:scroll">

        <h2 class="title page-header">{{ $event->course_name }} - {{ $event->academic_year }} - session n° {{ $event->exam_session }}</h2>
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
