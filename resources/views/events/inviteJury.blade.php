@extends( "layouts.template" )

@section( "title", "Ajouter un jury" )

@section( "content" )
    <h1>Ajouter un jury</h1>
    <ul>
        @if ($event->users)
            @foreach ($event->users as $jury)
                <li>
                    {{ $jury->name }}
                    <a href="{{ route("events.removeJury", ["event" => $event, "jury" => $jury]) }}" class="btn btn-danger">Enlever</a>
                </li>
            @endforeach
        @endif
    </ul>

    @include("events.forms.inviteJury")

    <a href="{{ route("events.show", $event) }}" class="btn btn-primary">Retour à l'événement</a>
@endsection
