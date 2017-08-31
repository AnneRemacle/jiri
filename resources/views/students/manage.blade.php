@extends( "layouts.template" )

@section( "title", "Gérer les étudiants" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            Gérer les étudiants
            <button type="button" class="btn btn-primary btn-sm green" data-toggle="modal" title="Ajouter un étudiant"  data-target="#add">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>

            <a href="{{ route("events.show", $event) }}" class="btn-sm btn green pull-right">Retour</a>
        </h2>
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Étudiants ajoutés</p>
                    </div>
                    {!! Form::open(["route" => ["implementations.updateOrStore", $event], "class" => "form-inline form-edit"]) !!}

                        <ul class="panel-body list-group">
                            @foreach ($performances as $performance)
                                <li class="list-group-item clearfix">
                                    <section>
                                        <h3>{{ $performance->student->name }}</h3>
                                        @foreach( $event->projects as $project )
                                            <section class="single-item">
                                                <h4 class="single-item__title">{{ $project->name }}</h4>

                                                @if( $event->implementations->where("project_id", $project->id)->where("student_id", $performance->student->id)->count() )
                                                    <div class="form-group">
                                                        {!! Form::label("results[".$performance->student->id."][".$project->id."][url_repo]", "URL repo") !!}
                                                        {!! Form::text(
                                                            "results[".$performance->student->id."][".$project->id."][url_repo]",
                                                            $event->implementations->where("project_id", $project->id)->where("student_id", $performance->student->id)->first()->url_repo,
                                                            ["class" => "form-control"])
                                                        !!}
                                                    </div>

                                                    <div class="form-group">
                                                        {!! Form::label("results[".$performance->student->id."][".$project->id."][url_project]", "URL projet") !!}
                                                        {!! Form::text(
                                                            "results[".$performance->student->id."][".$project->id."][url_project]",
                                                            $event->implementations->where("project_id", $project->id)->where("student_id", $performance->student->id)->first()->url_project,
                                                            ["class" => "form-control"])
                                                        !!}
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        {!! Form::label("results[".$performance->student->id."][".$project->id."][url_repo]", "URL repo") !!}
                                                        {!! Form::text(
                                                            "results[".$performance->student->id."][".$project->id."][url_repo]",
                                                            null,
                                                            ["class" => "form-control"])
                                                        !!}
                                                    </div>

                                                    <div class="form-group">
                                                        {!! Form::label("results[".$performance->student->id."][".$project->id."][url_project]", "URL projet") !!}
                                                        {!! Form::text(
                                                            "results[".$performance->student->id."][".$project->id."][url_project]",
                                                            null,
                                                            ["class" => "form-control"])
                                                        !!}
                                                    </div>
                                                @endif
                                            </section>
                                        @endforeach
                                    </section>
                                </li>
                            @endforeach
                        </ul>

                        {!! Form::submit("Enregistrer", ["class" => "btn btn-primary save-button"]) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <section class="row col-sm-8 col-md-offset-2 no-js">
            <h3 >Ajouter un étudiant à l'événement</h2>
            @include("students.forms.create")
        </section>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header title">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ajouter un étudiant</h4>
                    </div>
                    <div class="modal-body">
                        @include("students.forms.create")
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
