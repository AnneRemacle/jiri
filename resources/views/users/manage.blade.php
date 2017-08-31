@extends( "layouts.template" )

@section( "title", "Créer un projet" )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Jurys ajoutés</p>
                    </div>
                    {!! Form::open(["route" => ["meetings.updateOrStore", $event]]) !!}

                        <ul class="panel-body list-group">
                            @foreach ($event->users as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}

                                    @foreach( $event->performances as $performance )
                                        <p>{{ $performance->student->name }}</p>
                                        @if( $event->meetings->where("user_id", $user->id)->where("student_id", $performance->student->id)->count() )
                                            <input name="{{ "results[".$user->id."][".$performance->student->id."][start_time]" }}" value="{{ $event->meetings->where("user_id", $user->id)->where("student_id", $performance->student->id)->first()->start_time->format("H:i") }}">
                                            <input name="{{ "results[".$user->id."][".$performance->student->id."][end_time]" }}" value="{{ $event->meetings->where("user_id", $user->id)->where("student_id", $performance->student->id)->first()->end_time->format("H:i") }}">
                                        @else
                                            <input name="{{ "results[".$user->id."][".$performance->student->id."][start_time]" }}" value="" />
                                            <input name="{{ "results[".$user->id."][".$performance->student->id."][end_time]" }}" value="" />
                                        @endif
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>

                        {!! Form::submit("Enregistrer") !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <h2 class="page-header">Ajouter un jury</h2>
        @include("users.forms.create")
    </section>
@endsection
