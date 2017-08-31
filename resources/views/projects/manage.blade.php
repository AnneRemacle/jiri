@extends( "layouts.template" )

@section( "title", "Créer un projet" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            Gérer les projets
            <button type="button" class="btn btn-primary btn-sm green" data-toggle="modal" data-target="#add">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>

            <a href="{{ route("events.show", $event) }}" class="btn-sm btn green pull-right">Retour</a>
        </h2>
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Projets ajoutés</p>
                    </div>
                    {!! Form::open(["route" => ["projects.update", $event], "class" => "form-inline form-edit"]) !!}

                        <ul class="panel-body list-group">
                            @foreach ($event->projects as $project)
                                <li class="list-group-item clearfix">

                                        @if( $project->count() )
                                            <div class="form-group">
                                                {!! Form::label("name", "Nom") !!}
                                                {!! Form::text("name", $project->name, ["class" => "form-control"]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label("description", "Description") !!}
                                                {!! Form::textarea("description", $project->description, ["class" => "form-control", "rows" => "1"]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label("weight", "Pondération", ["class" => "form-label"]) }}
                                                {{ Form::text("weight", $project->weights->where("event_id", $event->id)->first()->weight, ["class" => "form-control form-control__text"]) }}
                                            </div>
                                        @else
                                            <div class="form-group">
                                                {!! Form::label("name", "Nom") !!}
                                                {!! Form::text("name", null, ["class" => "form-control"]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label("description", "Description") !!}
                                                {!! Form::textarea("description", null, ["class" => "form-control", "rows" => "1"]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label("weight", "Pondération", ["class" => "form-label"]) }}
                                                {{ Form::text("weight", null, ["class" => "form-control form-control__text"]) }}
                                            </div>
                                        @endif
                                        <a href="{{ route("events.removeProject", ["event" => $event, "project" => $project]) }}" class="btn btn-danger delete-button pull-right">Enlever</a>
                                </li>
                            @endforeach
                        </ul>

                        {!! Form::submit("Enregistrer", ["class" => "btn btn-primary save-button"]) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <section class="row col-sm-8 col-md-offset-2 no-js">
            <h3 >Ajouter un projet à l'événement</h2>
            @include("projects.forms.create")
        </section>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header title">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ajouter un projet</h4>
                    </div>
                    <div class="modal-body">
                        @include("projects.forms.create")
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
