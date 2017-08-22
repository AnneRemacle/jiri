@extends( "layouts.template" )

@section( "title", "Ajouter un étudiant" )

@section( "content" )
    <h1>Ajouter un étudiant</h1>
    <ul>
        @if ($event->students)
            @foreach ($event->students as $student)
                <li>
                    {{ $student->name }}
                    <a href="{{ route("events.removeStudent", ["event" => $event, "student" => $student]) }}" class="btn btn-danger">Enlever</a>
                </li>
            @endforeach
        @endif
    </ul>

    @include("events.forms.inviteStudent")

    <a href="{{ route("events.show", $event) }}" class="btn btn-primary">Retour à l'événement</a>
@endsection
