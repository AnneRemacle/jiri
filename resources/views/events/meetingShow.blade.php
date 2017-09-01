@extends( "layouts.template" )

@section( "title", $meeting->student->name )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <h2 class="page-header title">Rencontre avec {{ $meeting->student->name }}</h2>

        <section>
            <h3>Projets à évaluer</h3>
            @foreach( $meeting->student->implementations->where("event_id", $event->id) as $implementation )
                <section class="single-project">
                    <h4>
                        <a data-toggle="collapse" data-parent="#accordion" href="#project-{{$implementation->project->id}}" class="title-collapse" >
                        {{ $implementation->project->name }}
                        </a>
                    </h4>
                    <div id="project-{{$implementation->project->id}}" class="collapse single-event__content">
                        <div class="links">
                            <a href="{{ $implementation->project->url_repo }}" class="links__single">Voir le repo github</a>
                            <a href="{{ $implementation->project->url_project }}" class="links__single">Voir le projet</a>
                        </div>

                        @include( "scores.forms.update" )
                    </div>
                </section>

            @endforeach
        </section>

    </section>
@endsection


{{-- {{ $implementation->scores->where("meeting_id", $meeting->id)->first()["score"] }}/20 --}}
