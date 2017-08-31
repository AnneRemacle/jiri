@extends( "layouts.template" )

@section( "title", "Créer un projet" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">Gérer les projets</h2>
        <div class="row">
            <div class="col-sm-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Projets ajoutés</p>
                    </div>
                    {!! Form::open(["route" => ["projects.update", $event], "class" => "form-inline"]) !!}

                        <ul class="panel-body list-group">
                            @foreach ($event->projects as $project)
                                <li class="list-group-item">

                                        @if( $project->count() )
                                            <div class="form-group group-inline">
                                                {!! Form::label("name", "Nom") !!}
                                                {!! Form::text("name", $project->name, ["class" => "form-control"]) !!}
                                            </div>
                                            <div class="form-group group-inline">
                                                {!! Form::label("description", "Description") !!}
                                                {!! Form::textarea("description", $project->description, ["class" => "form-control", "rows" => "1"]) !!}
                                            </div>
                                        @else
                                            <div class="form-group group-inline">
                                                {!! Form::label("name", "Nom") !!}
                                                {!! Form::text("name", null, ["class" => "form-control"]) !!}
                                            </div>
                                            <div class="form-group group-inline">
                                                {!! Form::label("description", "Description") !!}
                                                {!! Form::textarea("description", null, ["class" => "form-control", "rows" => "1"]) !!}
                                            </div>
                                        @endif
                                        <a href="{{ route("events.removeProject", ["event" => $event, "project" => $project]) }}" class="btn btn-danger delete-button">Enlever</a>
                                </li>
                            @endforeach
                        </ul>

                        {!! Form::submit("Enregistrer", ["class" => "btn btn-primary"]) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <section class="row">
            <h3 >Ajouter un projet</h2>
            @include("projects.forms.create")
        </section>
    </section>
@endsection
