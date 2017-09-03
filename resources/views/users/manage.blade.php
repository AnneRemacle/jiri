@extends( "layouts.template" )

@section( "title", "Gérer les membres du jury" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            Gérer les membres du jury
            <button type="button" class="btn btn-primary btn-sm green" data-toggle="modal" title="Ajouter un juré" data-target="#add">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>

            <a href="{{ route("events.show", $event) }}" class="btn-sm btn green pull-right">Retour</a>
        </h2>
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Jurys ajoutés</p>
                    </div>
                    @if ($event->users->count())
                        {!! Form::open(["route" => ["meetings.updateOrStore", $event], "class" => "form-inline form-edit"]) !!}

                            <ul class="panel-body list-group">
                                @foreach ($event->users as $user)
                                    <li class="list-group-item">
                                        <section>
                                            <h3>{{ $user->name }}  <a href="{{ route("events.removeJury", ["event" => $event, "user" => $user]) }}" class="btn btn-danger pull-right">Supprimer</a></h3>
                                        </section>
                                        @foreach( $event->performances as $performance )
                                            <section class="single-item">
                                                <h4 class="single-item__title"><small>Rendez-vous avec </small>{{ $performance->student->name }}</h4>
                                                @if( $event->meetings->where("user_id", $user->id)->where("student_id", $performance->student->id)->count() )
                                                    {!! Form::label("results[".$user->id."][".$performance->student->id."][start_time]", "De") !!}
                                                    {!! Form::text(
                                                        "results[".$user->id."][".$performance->student->id."][start_time]",
                                                        $event->meetings->where("user_id", $user->id)->where("student_id", $performance->student->id)->first()->start_time->format("H:i"),
                                                        ["class" => "form-control flatpickr"])
                                                    !!}
                                                    {!! Form::label("results[".$user->id."][".$performance->student->id."][end_time]", "à") !!}
                                                    {!! Form::text(
                                                        "results[".$user->id."][".$performance->student->id."][end_time]",
                                                        $event->meetings->where("user_id", $user->id)->where("student_id", $performance->student->id)->first()->end_time->format("H:i"),
                                                        ["class" => "form-control flatpickr"])
                                                    !!}
                                                @else
                                                    {!! Form::label("results[".$user->id."][".$performance->student->id."][start_time]", "De") !!}
                                                    {!! Form::text(
                                                        "results[".$user->id."][".$performance->student->id."][start_time]",
                                                        null,
                                                        ["class" => "form-control"])
                                                    !!}
                                                    {!! Form::label("results[".$user->id."][".$performance->student->id."][end_time]", "à") !!}
                                                    {!! Form::text(
                                                        "results[".$user->id."][".$performance->student->id."][end_time]",
                                                        null,
                                                        ["class" => "form-control"])
                                                    !!}
                                                @endif
                                            </section>
                                        @endforeach
                                    </li>
                                @endforeach
                            </ul>

                            {!! Form::submit("Enregistrer", ["class" => "btn btn-primary save-button"]) !!}

                        {!! Form::close() !!}
                    @else
                        <p class="list-group-item">
                            Il n'y a pas encore de jurys invités à cet événement
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <section class="row col-sm-8 col-md-offset-2 no-js">
            <h3 >Ajouter un jury</h2>
            @include("users.forms.create")
        </section>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header title">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ajouter un jury</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="modal-body">
                        @include("users.forms.create")
                    </div>
                </div>
            </div>
        </div>

    </section>

    @if( $errors->any() && old("results") == null )
        <script type="text/javascript">
            $("#add").modal("show")
        </script>
    @endif

@endsection
