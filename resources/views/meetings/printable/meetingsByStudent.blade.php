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
            position: relative;
        }

    </style>
</head>
<body>
    @foreach( $event->students as $student )
        <section class="meeting">
        <h3>{{ $student->name }}</h3>
        @foreach( $event->meetings->where("student_id", $student->id) as $meeting )
            {{ $meeting->user->name }}:
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
