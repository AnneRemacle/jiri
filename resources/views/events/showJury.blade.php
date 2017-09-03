@extends( "layouts.template" )

@section( "title", $event->course_name )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            <span>{{ $user->name }}</span>
            <a href="{{ route("events.show", $event) }}" class="btn-sm btn green">Retour</a>
        </h2>
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <section class="single-item">
                            @foreach( $user->meetings->where("event_id", $event->id) as $meeting )
                                <h3 class="single-item__title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#project-{{$meeting->student->id}}" class="title-collapse" >
                                        {{ $meeting->student->name }}
                                    </a>
                                </h3>
                                <section class="collapse" id="project-{{$meeting->student->id}}">
                                    @foreach( $meeting->scores as $score )
                                        <h4>Cote pour {{ $score->implementation->project->name }}&nbsp;: {{ $score->score ? $score->score+"/20" : "Pas encore de cote" }}</h4>
                                        <div class="single-item__content">
                                            <p><strong>Commentaire:</strong></p>
                                            @if ( $score->comment )
                                                <p>{{ $score->comment }}</p>
                                            @else
                                                <p>Pas de commentaire pour ce projet</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </section>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
