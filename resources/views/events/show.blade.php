@extends( "layouts.template" )

@section( "title", $event->course_name )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="title page-header">Modifier l'événement&nbsp;: {{ $event->course_name }} - {{ $event->academic_year }} - session n° {{ $event->exam_session }}</h2>
        <a href="{{ route("projects.create", $event) }}" class="btn btn-primary">Ajouter un projet</a>

        @if( $event->projects->count() )
            <a href="{{ route("students.create", $event) }}" class="btn btn-primary">Ajouter un étudiant</a>
        @endif

        @if( $event->performances->count() )
            <a href="{{ route("events.inviteJury", $event) }}" class="btn btn-primary">Ajouter un jury</a>
        @endif

        @if( $event->meetings->count() )
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
                                    <td colspan="{{ $event->projects->count() }}">No meeting</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @else
            <div class="row">
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p class="panel-title">Projets</p>
                        </div>
                        <ul class="panel-body list-group">
                            @foreach ($event->projects as $project)
                                <li class="list-group-item">
                                    {{ $project->name }}
                                    {{-- TODO: link to project --}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif
    </section>
@endsection
