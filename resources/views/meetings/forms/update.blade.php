{!! Form::model($meeting, ["route" => ["meetings.update", $meeting], "method" => "PUT"]) !!}
    {!! Form::label("general_evaluation", "Évaluation générale") !!}
    {!! Form::text("general_evaluation", $meeting->general_evaluation) !!}

    {!! Form::submit("Valider") !!}
{!! Form::close() !!}
