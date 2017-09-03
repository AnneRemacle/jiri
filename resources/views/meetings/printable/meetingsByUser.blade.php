<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style media="screen">
        section{ page-break-inside: avoid; }
        html {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .meeting {
            padding: 1em;
            border-bottom: 1px dashed black;
        }
    </style>
</head>
<body>
    @foreach( $event->users as $user )
        <section class="meeting">
            <h3>{{ $user->name }}</h3>
            <p><strong>Email: </strong>{{ $user->email }}</p>
            <p><strong>Mot de passe: </strong>{{ $user->clear_password }}</p>
            @foreach( $event->meetings->where("user_id", $user->id) as $meeting )
                {{ $meeting->student->name }}:
                @if ( is_null($meeting->start_time) && is_null($meeting->end_time) )
                    <span>Pas d'horaire renseigné</span>
                @else
                    <span>
                        de {{ $meeting->start_time->format("H:i") }}
                        à {{ $meeting->end_time->format("H:i") }}
                    </span>
                @endif
                <br/>
            @endforeach
        </section>
    @endforeach
</body>
</html>
