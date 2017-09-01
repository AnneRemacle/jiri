@extends( "layouts.template" )

@section( "title", $event->course_name )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">
            <span>{{ $student->name }}</span>
            <a href="{{ route("events.show", $event) }}" class="btn-sm btn green">Retour</a>
            <span class="pull-right small">
                <span>Cote finale calculée&nbsp;: {{ $student->weighted_calculated_final( $event )}}/20</span>
                 |
                <span>Cote finale délibérée&nbsp;: {{ $student->performances->where("event_id", $event->id)->first()->manual_score }}/20</span>
            </span>
        </h2>
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                          <li class="active" role="presentation"><a data-toggle="tab" href="#projects">Cotes par projet</a></li>
                          <li role="presentation"><a data-toggle="tab" href="#users">Cotes par jurys</a></li>
                          <li role="presentation"><a data-toggle="tab" href="#performance">Détail de la cote finale</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="fade in tab-pane active" id="projects">
                                <section class="single-item">
                                    @foreach( $student->implementations->where("event_id", $event->id) as $implementation )
                                        <h3 class="single-item__title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#project-{{$implementation->project->id}}" class="title-collapse" >
                                                {{ $implementation->project->name }}
                                            </a>
                                        </h3>
                                        <section class="collapse" id="project-{{$implementation->project->id}}">
                                            @foreach( $implementation->scores as $score )
                                                <h4>Cote de {{ $score->meeting->user->name }}&nbsp;: {{ $score->score ? $score->score+"/20" : "Pas encore de cote" }}</h4>
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
                            <div role="tabpanel" class="fade tab-pane" id="users">
                                <section class="single-item">
                                    @foreach( $student->meetings->where("event_id", $event->id) as $meeting )
                                        <h3 class="single-item__title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#user-{{$meeting->user->id}}" class="title-collapse" >
                                                {{ $meeting->user->name }}
                                            </a></h3>
                                        <section class="collapse" id="user-{{$meeting->user->id}}">
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
                            <div role="tabpanel" class="fade tab-pane" id="performance">
                                <section>
                                    <h3 class="single-item__title">Note moyenne par projet</h3>
                                    <div class="single-item__content">
                                        @foreach( $student->implementations->where("event_id", $event->id) as $implementation )
                                            <p>
                                                <strong>{{ $implementation->project->name }}: </strong>
                                                {{ ( $implementation->scores->avg("score") ) }}/20
                                            </p>
                                        @endforeach
                                    </div>
                                </section>
                                <section>
                                    <h3 class="single-item__title">Évaluation globale moyenne</h3>
                                    <p>
                                        <strong>Résultat de l'évalutation globale moyenne&nbsp;:</strong>{{ $student->average_general_evaluation($event) }}/20
                                    </p>
                                </section>
                                <section>
                                    <h3 class="single-item__title">Note finale calculée</h3>
                                    <p>
                                        <strong>Résultat de la note finale calculée&nbsp;:</strong>
                                        {{ $student->weighted_calculated_final( $event ) }}/20
                                    </p>

                                </section>
                                <section>
                                    <h3 class="single-item__title">Note finale de la délibération</h3>
                                    @include("performances.forms.edit")
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
