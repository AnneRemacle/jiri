@extends( "layouts.template" )

@section( "title", "Dashboard de $user->name" )

@section( "content" )
    @include("layouts.header")

    <section class="main">
        <h2>{{ $event->course_name }} - {{ $event->academic_year }} - session n° {{ $event->exam_session }}</h2>
        <p class="subtitle">Professeur responsable: {{$event->owner->name}}</p>
        <ul>
            @foreach($event->students as $student)
            <li>{{ $student->name }} - {{ $student->performances->first()->manual_score }}</li>
            @endforeach
        </ul>
    </section>

@endsection
