@extends( "layouts.template" )

@section( "title", "Ajouter un étudiant" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Étudiants</p>
                    </div>
                    {!! Form::open(["route" => ["implementations.updateOrStore", $event]]) !!}

                        <ul class="panel-body list-group">
                            @foreach ($performances as $performance)
                                <li class="list-group-item">
                                    {{ $performance->student->name }}

                                    @foreach( $event->projects as $project )
                                        <p>{{ $project->name }}</p>
                                        @if( $event->implementations->where("project_id", $project->id)->where("student_id", $performance->student->id)->count() )
                                            <input name="{{ "results[".$performance->student->id."][".$project->id."][url_repo]" }}" value="{{ $event->implementations->where("project_id", $project->id)->where("student_id", $performance->student->id)->first()->url_repo }}">
                                            <input name="{{ "results[".$performance->student->id."][".$project->id."][url_project]" }}" value="{{ $event->implementations->where("project_id", $project->id)->where("student_id", $performance->student->id)->first()->url_project }}">
                                        @else
                                            <input name="{{ "results[".$performance->student->id."][".$project->id."][url_repo]" }}" value="" />
                                            <input name="{{ "results[".$performance->student->id."][".$project->id."][url_project]" }}" value="" />
                                        @endif
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>

                        {!! Form::submit("save") !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <h2 class="page-header">Ajouter un étudiant</h2>
        @include("students.forms.create")
    </section>
@endsection
